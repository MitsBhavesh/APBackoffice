<?php

namespace App\Http\Controllers;
use App\Http\Controllers\index;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function index(){
        echo view('herder');
        echo view('home');
        echo view('footer');
    }   
} 
