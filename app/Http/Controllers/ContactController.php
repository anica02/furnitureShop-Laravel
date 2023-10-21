<?php

namespace App\Http\Controllers;

use App\Helpers\ActivityLogger;
use App\Http\Requests\MessageAdminRequest;
use App\Models\Message;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ContactController extends MainController
{
    public function index(){
        $admins=DB::table('users')->where('id_role', '=', 1)->get();
        return view('pages.main.contact', ["admins"=>$admins]);
    }

    public function message(MessageAdminRequest $request){
        try{

            $message=new Message();
            $message->user=session()->get('user')->email;
            $message->message=$request->get('message');
            $message->id_admin=$request->get('admin');
            $message->save();
            ActivityLogger::LogActivity("Message sent", "user=".session()->get('user')->email);
            return  redirect()->back()->with("success", "Message sent ");
        }catch(\Exception $e){
            ActivityLogger::LogActivity("Error while sending message ", "user=".session()->get('user')->email);
            Log::error(  $e->getMessage(). " " . $e->getTraceAsString());
            return  redirect()->back()->with("error", "An error has occurred while sending your message");
        }
    }
}
