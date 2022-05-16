<?php
namespace App\Services\Auth;
use App\Services\BaseService;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use function auth;
use function event;

class AuthService extends BaseService
{
    public function register($data)
    {
        try {
            \DB::beginTransaction();

            $user = new User();
            $user->name = $data['full_name'];
            $user->email = $data['email'];
            $user->password = Hash::make($data['password']);
            $user->save();


            $data['full_name'] = $data['full_name'];
            $data['email'] = $data['email'];
            $data['token'] = $user->createToken($data['email'])->plainTextToken;
            return $data;
            //event(new Registered($user));
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            $this->addErrors([$e->getMessage()]);
            return false;
        }
    }

    public function login($request)
    {
        //if valid username and password given create and return login token
        $credentials = $request->only('email', 'password');
        if ($token = auth()->attempt($credentials)) {
            Auth::user()->update(['last_login' => Carbon::now()]);
            return $token;
        }
        //if invalid username or password given create error and return false
        $this->addError("auth", "Invalid email or password");
        return false;
    }

    public function logout()
    {
        Auth::logout();
        return true;
    }

    /**
     * Return auth guard
     */
    private function guard()
    {
        return Auth::guard();
    }
}
