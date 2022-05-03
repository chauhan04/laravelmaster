<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    public function index() {
        $pageMetaTitle = 'Home Page';
        $pageTitle = 'Home Page';

        return view('frontend.index',compact(['pageMetaTitle','pageTitle']));
    }
}
