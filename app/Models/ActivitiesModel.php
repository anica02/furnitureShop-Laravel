<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActivitiesModel extends Model
{
    use HasFactory;


    function searchActivities(Request $request){
        $query=DB::table('activities');

        if($request->has("nameAc") && $request->get('nameAc')!=""){
            $query = $query->where('name', '=', $request->get("nameAc"));
            $request->session()->put("nameAc",$request->get("nameAc") );
        }

        if($request->has("userAc") && $request->get('userAc')!=""){
            $query = $query->where('user', '=', $request->get("userAc"));
            $request->session()->put("userAc",$request->get("userAc") );
        }
        $perPage = 10;
        $query=$query->orderByDesc('id');
        $query=$query->select(['id', 'name', 'date', 'request_data', 'user']);

        return $query->paginate($perPage)->withQueryString();

    }

}
