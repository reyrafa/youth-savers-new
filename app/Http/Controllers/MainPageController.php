<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainPageController extends Controller
{
    public function index(){ //home
        return view('pages.main-page.home.home');
    }
}
