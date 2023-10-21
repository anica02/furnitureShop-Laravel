<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MessageModel
{
    use HasFactory;


    function searchMessages(Request $request){
        $query=DB::table('messages')->where('id_admin', '=', session()->get('user')->id);

        if($request->has("emailMsg") && $request->get("emailMsg")!=" "){
            $query = $query->where('user', '=', $request->get("emailMsg"));
            $request->session()->put("emailMsg",$request->get("emailMsg") );
        }

        $perPage = 5;
        $query=$query->orderByDesc('id');

        $query=$query->select(['id', 'message', 'created_at', 'user']);

        return $query->paginate($perPage)->withQueryString();

    }





}
