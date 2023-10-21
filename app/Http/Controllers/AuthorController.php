<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthorController extends MainController
{
    public function index(){
        return view('pages.main.author');
    }
}
