<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class Notification extends Controller
{
    public function index(){
        $conn = DB::connection('sqlsrv');
        $res = $conn->select("SET NOCOUNT ON; EXEC pro_seletNotification ");
        // print_r($res); exit;
        echo view('herder',['res'=>$res]);
        echo view('footer');
    } 
}
