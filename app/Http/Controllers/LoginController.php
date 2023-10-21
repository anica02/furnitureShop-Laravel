<?php

namespace App\Http\Controllers;

use App\Helpers\ActivityLogger;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class LoginController extends MainController
{
    public function index(){
         return view('pages.main.login');
    }

    public function login(Request $request){
        try {
            $email = $request->email;
            $password = $request->password;

            $user = User::where('email', $email)->first();
            if (!$user) {
                ActivityLogger::LogActivity("User not found","user=".$email);
                return redirect()->back()->with('error', 'No user found!');
            }
            if ($user->active == 0) {
                ActivityLogger::LogActivity("User blocked", "user=".$email);
                return redirect()->back()->with('error', 'Your account is blocked');
            }
            $passwordMatches = $user->password == md5($password);
            if($passwordMatches){

                $request->session()->put("user", $user);
                ActivityLogger::LogActivity("Login", "user=".$email );

                if(session()->get('user')->id_role==2){
                    return redirect()->route('home-user');
                }else{
                    return redirect()->route('home-admin');
                }



            }
            else{
                return redirect()->back()->with('error', 'Wrong password');
            }


        }catch (\Exception $e){
            ActivityLogger::LogActivity("Login error", "user=".$email);
            Log::error($e->getMessage(). "\n". $e->getTraceAsString());
            return redirect()->back()->with('error', 'An error occurred while login');
        }

    }

    public  function logout(Request $request) {
        ActivityLogger::LogActivity("Logout", "user=".$request->session()->get('user')->email);
        $request->session()->flush();
        return redirect()->route("login-form");
    }

}
