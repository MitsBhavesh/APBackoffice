<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class Login extends Controller
{
    public function index()
    {
        // echo view('herder');
        echo view('home');  
        // echo view('footer');
       
    } 

    public function GETdata(Request $Request)
    {
        // exit;
        $apcode = $_POST['apcode'];
        $password = $_POST['password'];
        
        $conn = DB::connection('sqlsrv');
        $res = $conn->select("SET NOCOUNT ON; EXEC pro_profile '$apcode','$password'  ");
        // $res = $conn->select("SET NOCOUNT ON; EXEC pro_profile '".$apcode."','".$password."' ");
        // print_r($res);
        // exit;
        // Store a value in the session
        // session()->put('key', 'value');

        $Request->Session()->put('Login_Email',$res);
        // $Request->session()->put('Emp_Code',$emp_code);
        // Session::put('myarray', $res);
        if(!empty($res))
        {
            return redirect('post')->with('status',"Wel come!");
        }else{
            return back()->with('error','Invaild Id and Password!');
            // print_r("Data can not found!");
        }
    
    }
}
