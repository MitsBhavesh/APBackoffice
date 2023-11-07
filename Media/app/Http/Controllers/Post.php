<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class Post extends Controller
{
    public function index(){

        // print_r(json_encode(Session()->get('Login_Email')[0]));
        // exit;

        if(isset($_GET['postid'])) {

            $UserId = Session()->get('Login_Email')[0]->ID;
            $postid = $_GET['postid'];

            $conn = DB::connection('sqlsrv');
            $user = $conn->select("SELECT * FROM tbl_Notification WHERE Id = ".$postid);

            $expData = explode(",", $user[0]->users);
            array_push($expData, $UserId);
            $impData = implode(",", $expData);
            // print_r($impData);
            // exit;

            // Update Data
            $conn = DB::connection('sqlsrv');
            try{
                $userUpdate = $conn->select("UPDATE tbl_Notification SET users = '$impData' WHERE Id = ".$postid);
            } catch (\Exception $e) {
            }
            // print_r("UPDATE tbl_Notification SET users = '$impData' WHERE Id = ".$postid);
            exit;
        }

        $conn = DB::connection('sqlsrv');
        $user = $conn->select("SET NOCOUNT ON; EXEC pro_postselect");

        $conn = DB::connection('sqlsrv');
        $fuser = $conn->select("SET NOCOUNT ON; EXEC pro_Fpost");
        // print_r($fuser); exit;

        $conn = DB::connection('sqlsrv');
        $res = $conn->select("SET NOCOUNT ON; EXEC pro_profileselect");

        $conn = DB::connection('sqlsrv');
        $nres = $conn->select("SET NOCOUNT ON; EXEC pro_seletNotification");

        // print_r($nres);
        // exit;

        echo view('herder',['nres'=>$nres]);
        // echo view('viewrecore',['user'=>$user]);  
        echo view('post',['user'=>$user,'res'=>$res,'fuser'=>$fuser]);  
        echo view('footer');
    } 

    
}
