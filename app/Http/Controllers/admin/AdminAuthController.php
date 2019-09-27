<?php

namespace App\Http\Controllers\admin;

use DB;
use Mail;
use App\Admin;
use Carbon\Carbon;
use App\Mail\ResetAdminPassword;
use App\Http\Controllers\Controller;
// use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function login() {

        return view('admin.login');
    }

    public function toLogin() {
        
        $rememberme = request('rememberme') == 1 ? true : false;
        if(admin()->attempt(['email' => request('email'), 'password' => request('password')], $rememberme)) {
            
            return redirect()->route('adminHome');
        }else {
            session()->flash('error', trans('admin.admin_login_info_incorrect'));
            return redirect(aurl('login'));
        }
    }

    public function logout() {

        admin()->logout();
        return redirect(aurl('login'));
    }

    public function forgotPassword(){

        return view('admin.forgotPassword');
    }

    public function forgotPasswordPost()
    {
     $admin = Admin::where('email', request('email'))->first();
     if(!empty($admin)){
        $token = app('auth.password.broker')->createToken($admin);
        DB::table('password_resets')->insert([
                'email' => $admin->email,
                'token' => $token,
                'created_at' => Carbon::now(),
                ]);
        
        Mail::to($admin->email)->send(new ResetAdminPassword(['admin' => $admin, 'token' => $token]));
        session()->flash('success', 'An email is sent, please check your email inbox');
        return back();
     }
     session()->flash('error', 'This email doesn\'t exist, try again!');
     return back();
    }

    public function resetPassword($token)
    {
        $check_token = DB::table('password_resets')
                            ->where('token', $token)
                            ->where('created_at', '>=', Carbon::now()->subHours(1))->first();
        if(!empty($check_token)){
            return view('admin.reset_password', [
                'email' => $check_token->email,
            ]);
        }else {
            return redirect(aurl('forgot/password'));
        }
    }

    public function resetPasswordPost($token)
    {
        $this->validate(request(), [
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required',
        ], [], [
            'password' => 'Password',
            'password_confirmation' => 'Password Confirmation',
        ]);
        $check_token = DB::table('password_resets')
                            ->where('token', $token)
                            ->where('created_at', '>=', Carbon::now()->subHours(1))->first();
        if(!empty($check_token)){
            $admin = Admin::where('email', $check_token->email)->first();
            $admin->password = bcrypt(request()->password);

            $admin->save();
            DB::table('password_resets')->where('token', $check_token->token)->delete();
            admin()->attempt(['email' => $admin->email, 'password' => request()->password]);
            return redirect(aurl());
        }else{
            session()->flash('error', 'Your request for password resetting is outdated, try again!');
            return redirect(aurl('forgot/password'));
        }
    }

}
