<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\administration;

class pagesController extends Controller
{
    public function __construct()
    {
        // authenticat user access 
        $this->middleware('auth');
    }
    public function index(){
        return view('pages.school');
    }
    public function school(){
        return view('pages.school');
    }
    public function about(){
        return view('pages.about');
    }
}
