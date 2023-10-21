<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends MainController
{

    public function index(){


        $this->data['rooms']=[
            [
                "src"=>"room1.jpg",
                "alt"=>"Room 1"
            ],
            [
                "src"=>"room2.jpg",
                "alt"=>"Room 2"
            ],
            [
                "src"=>"room5.jpg",
                "alt"=>"Room 5"
            ],
            [
                "src"=>"room4.jpg",
                "alt"=>"Room 4"
            ]
         ];

        $this->data['categoryId']=Category::all();
        return view('pages.main.home', ["data"=> $this->data]);
    }


}
