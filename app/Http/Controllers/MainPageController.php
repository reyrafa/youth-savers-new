<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainPageController extends Controller
{
    public function index(){ //home
        return view('pages.main-page.home.home');
    }

    public function about_us(){
        return view('pages.main-page.about-us.about');
    }

    public function contact_us(){
        return view('pages.main-page.contact-us.index');
    }

    public function savings(){
        return view('pages.main-page.savings.index');
    }

    public function downloadable_forms(){
        return view('pages.main-page.downloadable-forms.index');
    }
}
