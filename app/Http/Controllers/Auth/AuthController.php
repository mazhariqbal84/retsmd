<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;

use App\Http\Requests\Auth\ForgetRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\OtpVerifiedRequest;
use App\Http\Requests\Auth\PasswordChangeRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\ResendOtpCodeRequest;
use App\libs\Response\GlobalApiResponse;
use App\libs\Response\GlobalApiResponseCodeBook;
use App\Services\Auth\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request)
    {
        // Call the function form Service
        $data =$this->authService->register($request->all());
        //Check If error is come
        if ($this->authService->hasError()) {
         return (new GlobalApiResponse())->error(GlobalApiResponseCodeBook::INVALID_CREDENTIALS, 'Invalid Credentials', $this->authService->getErrors());
        }
        // Success responce
        return (new GlobalApiResponse())->success('Register Successfully.', 1,$data);

    }

    public function login(LoginRequest $request)
    {
        // Call the function form Service
        $data =$this->authService->login($request->all());
        //Check If error is come
        if ($this->authService->hasError()) {
            return (new GlobalApiResponse())->error(GlobalApiResponseCodeBook::INVALID_CREDENTIALS, 'Invalid Credentials', $this->authService->getErrors());
        }
        // Success responce
        return (new GlobalApiResponse())->success('login Successfully.', 1,$data);
    }


    public function forget_password(ForgetRequest $request)
    {
        // Call the function form Service
          $data =$this->authService->forgetpassword($request->all());
        //Check If error is come
        if ($this->authService->hasError()) {
            return (new GlobalApiResponse())->error(GlobalApiResponseCodeBook::INVALID_FORM_INPUTS, 'Invalid Form Input', $this->authService->getErrors());
        }
        // Success responce
        return (new GlobalApiResponse())->success($data, 1);

    }
    public function otp_verify(OtpVerifiedRequest $request)
    {
        // Call the function form Service
        $data =$this->authService->otp_verify($request->all());
        //Check If error is come
        if ($this->authService->hasError()) {
            return (new GlobalApiResponse())->error(GlobalApiResponseCodeBook::INVALID_FORM_INPUTS, 'Invalid Form Input', $this->authService->getErrors());
        }
        // Success responce
        return (new GlobalApiResponse())->success($data, 1);

    }

    public function password_change(PasswordChangeRequest $request)
    {
        // Call the function form Service
        $data =$this->authService->password_change($request->all());
        //Check If error is come
        if ($this->authService->hasError()) {
            return (new GlobalApiResponse())->error(GlobalApiResponseCodeBook::INVALID_FORM_INPUTS, 'Invalid Form Input', $this->authService->getErrors());
        }
        // Success responce
        return (new GlobalApiResponse())->success($data, 1);

    }

    public function resend_otp_code(ResendOtpCodeRequest $request)
    {
        // Call the function form Service
        $data = $this->authService->resend_otp_code($request->all());
        //Check If error is come
        if ($this->authService->hasError()) {
            return (new GlobalApiResponse())->error(GlobalApiResponseCodeBook::INVALID_FORM_INPUTS, 'Invalid Form Input', $this->authService->getErrors());
        }
        // Success responce
        return (new GlobalApiResponse())->success($data, 1);

    }

    public function refresh(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();

        $data['full_name'] = $user->name;
        $data['email'] = $user->email;
        $data['token'] = $user->createToken($user->email)->plainTextToken;
        return $data;
        return (new GlobalApiResponse())->success('login Successfully.', 1,$data);

    }

    public function user()
    {
        $data['id'] = auth()->user()->id;
        $data['full_name'] = auth()->user()->name;
        $data['email'] = auth()->user()->email;

        return (new GlobalApiResponse())->success('User Profile Data.', 1,$data);
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        return (new GlobalApiResponse())->success('You have successfully logged out and the token was successfully deleted', 1);
    }
}
