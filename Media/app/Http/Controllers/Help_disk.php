<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Help_disk extends Controller
{
    public function index(){
        echo view('herder');
        echo view('help_disk');
        echo view('footer');
    } 
}
