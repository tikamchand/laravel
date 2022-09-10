<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
   function Home(){
    return view('home.index');
   }
   function Contact(){
    return view('home.contact');
   }
   function Secret(){
    return view('home.secret');
   }
}
