<?php
namespace App\Services\Auth;
use App\Services\BaseService;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use function auth;
use function event;

class AuthService extends BaseService
{
    public function register($request)
    {

            $user = new User();
            $user->name = $request['full_name'];
            $user->email = $request['email'];
            $user->password = Hash::make($request['password']);
            $user->save();
            $data['id'] = $user->id;
            $data['full_name'] = $request['full_name'];
            $data['email'] = $request['email'];
            $data['token'] = $user->createToken($request['email'])->plainTextToken;
            return $data;
            //event(new Registered($user));
    }

    public function login($request)
    {
        if (auth()->attempt($request)) {
            $data['id'] = auth()->user()->id;
            $data['full_name'] = auth()->user()->name;
            $data['email'] = auth()->user()->email;
            $data['token'] = auth()->user()->createToken($data['email'])->plainTextToken;
            return $data;
        }
        //if invalid username or password given create error and return false
        $this->addError("auth", "Invalid email or password");
        return false;
    }

    public function forgetpassword($request)
    {
        try
        {
            // TODO: Check if phone is exits in Portals which having
            $checkEmail = User::where(['email' => $request['email']])->first();

            // TODO: If record not found return false
            if(is_null($checkEmail)) return $this->addError("forget", "This email doesn't macth to our records.");

            //Creating 4 Digit Verification Code
            $code = mt_rand(1000,9999);

            //TODO:  Getting User and updating it
            $user = User::find($checkEmail->id);
            $user->otp = $code;
            $user->save();
            $data["reser_password_code"] = $code;
            $data["title"] = 'Forget Password OTP';
            $mail = $request['email'];
            Mail::send('emails.reset-password', $data, function($message)use($data,$mail) {
                $message->to($mail)
                    ->subject($data["title"]);
            });
            return "A 4 digit OTP has been sent to your registered email.";
        }catch(\Exception $ex)
        {
            $this->addErrors([$ex->getMessage()]);
        }
    }

    // TODO: Reset Password Code
    public function otp_verify($request)
    {
        try
        {

            // TODO: Check if phone is exits in Portals which having
            $checkCode = User::where(['otp' => $request['code'],'email' => $request['email']])->first();

            // TODO: If record not found return false
            if(is_null($checkCode)) return $this->addError('code',"This code doesn't macth to our records.");

            //TODO:  Getting User and updating it
            $user = User::find($checkCode->id);
            User::where('id',$user->id)->update(['otp' => Null]);
            return "4 digit OTP has been Verified";
        }catch(\Exception $ex)
        {
            $this->addErrors([$ex->getMessage()]);
        }
    }


    // TODO: Chnage Password Process Start here
    public function password_change($request)
    {
        try
        {
            // TODO: Check if phone is exits in Portals which having
            $checkUser = User::where(['email' => $request['email']])->first();
            // TODO: If record not found return false
            if(is_null($checkUser)) return $this->addError("email", "This email address doesn't macth to our records.");
            //TODO:  Getting User and updating it
            $user = User::find($checkUser->id);
            User::where('id',$user->id)->update(
                ['password' => Hash::make($request['password'])]
            );
            return 'Password rest successfully!';
        }catch(\Exception $ex) {
            $this->addErrors([$ex->getMessage()]);
        }
    }

    //Resending Verification Code
    public function resend_otp_code($request)
    {
        try{
            //Creating 4 Digit Verification Code
            $code = mt_rand(1000,9999);
            //Updating the verification code
            User::where(['email' => $request['email']])->update(['otp' => $code]);

            //TODO:  Getting User and updating it

            $data["reser_password_code"] = $code;
            $data["title"] = 'Forget Password OTP Resend';
            $mail = $request['email'];
            Mail::send('emails.reset-password', $data, function($message)use($data,$mail) {
                $message->to($mail)
                    ->subject($data["title"]);
            });
            return "A 4 digit OTP has been sent to your registered email.";
        }catch(\Exception $ex){
            $this->addErrors([$ex->getMessage()]);
        }
    }

}
