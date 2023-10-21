<?php

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ActivityLogger
{
    public  static function LogActivity($name,$data) {


        DB::table("activities")->insert([
            "name" => $name,
            "date" => \Carbon\Carbon::now()->toDateTimeString(),
            "user" => session()->has("user") ? session()->get("user")->email : request()->ip(),
            "request_data" => $data
        ]);
    }

    public  static function LogActivityReq($name) {

        $requestData = json_encode(request()->all());

        DB::table("activities")->insert([
            "name" => $name,
            "date" => \Carbon\Carbon::now()->toDateTimeString(),
            "user" => session()->has("user") ? session()->get("user")->email : request()->ip(),
            "request_data" => $requestData
        ]);
    }
}
