<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class Video extends Controller
{
    public function index(){

        $conn = DB::connection('sqlsrv');
        $res = $conn->select("SET NOCOUNT ON; EXEC pro_videoselect ");

        // print_r($res); exit;
        echo view('herder');
        echo view('video',['res'=>$res]);
        echo view('footer');
    } 
}
