<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
 public function __invoke(){
    return "This text is about single action controller";
 }  
}
