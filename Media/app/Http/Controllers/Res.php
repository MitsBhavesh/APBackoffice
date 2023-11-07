<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Res extends Controller
{
    public function index(){
        echo view('res');
    } 
}
