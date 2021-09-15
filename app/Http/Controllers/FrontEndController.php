<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    public function index(){
        return view('frontend.frontpage');
    }
    public function aboutUs(){
        return view('frontend.aboutus');
    }
    public function privacyPolicy(){
        return view('frontend.privacy_policy');
    }
    public function termsCondition(){
        return view('frontend.terms_condition');
    }
}
