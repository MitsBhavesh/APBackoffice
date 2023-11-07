<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class update extends Controller
{
    // public function index(){
    //     echo view('herder');
    //     echo view('update');
    //     echo view('footer');
    // } 

    public function index(){
        
      
        $conn = DB::connection('sqlsrv');
        $res = $conn->select("SET NOCOUNT ON; EXEC pro_updateselect ");
        // print_r($res);exit;
        // return view('update')->with('res', $res);
        echo view('herder');
        echo view('update',['res'=>$res]);
        echo view('footer');
    }    
   
}
