<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Home extends Controller
{
    public function index(){
        // echo view('herder');
        echo view('home');
        // echo view('footer');
    } 
}
