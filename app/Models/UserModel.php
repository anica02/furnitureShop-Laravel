<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserModel extends Model
{
    use HasFactory;

    function searchUsers(Request $request){
        $query=DB::table('users');

        if($request->has("emailU") && $request->get('emailU')!=""){
            $query = $query->where('email', '=', $request->get("emailU"));
            $request->session()->put("emailU",$request->get("emailU") );
        }
        if($request->has("roleU") && $request->get('roleU')!=""){
            $query = $query->where('id_role', '=', (int)$request->get("roleU"));
            $request->session()->put("roleU",$request->get("roleU") );
        }
        if($request->has("statusU") && $request->get('statusU')!=""){
            $query = $query->where('active', '=', (int)$request->get("statusU"));
            $request->session()->put("statusU",$request->get("statusU") );
        }
        $perPage = 5;
        $query=$query->orderByDesc('id');
        $query=$query->select(['id', 'first_name', 'created_at', 'last_name', 'email', 'id_role', 'active']);

        return $query->paginate($perPage)->withQueryString();

    }
}
