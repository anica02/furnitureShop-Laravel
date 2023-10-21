<?php

namespace App\Http\Controllers;

use App\Helpers\ActivityLogger;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RegisterController extends MainController
{
    public function register(){
        return view('pages.main.register');
    }

    public function post(RegisterUserRequest $request){
        try{
            $passwordMd5=md5($request->get('password'));

            $user=new User();
            $user->first_name=$request->get('firstName');
            $user->last_name=$request->get('lastName');
            $user->email=$request->get('email');
            $user->password=$passwordMd5;
            $user->id_role=2;
            $user->active=1;
            $user->save();

            ActivityLogger::LogActivity("User registered", "email=".$user->email);
            return redirect()->route('login')->with('success', 'Successful registration');
        }catch(\Exception $e){
            ActivityLogger::LogActivity("Error while registering","email=".$user->email);
            Log::error($e->getMessage(). "\n". $e->getTraceAsString());
            return redirect()->back()->with('error-msg', 'An error occurred while registering');
        }

    }
}
