<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class Edit_profile extends Controller
{
    public function index()
    {
        echo view('herder');
        echo view('layouts/profileview');
        // echo view('layouts/edit_profile');
        echo view('footer');
    } 
    public function Update(Request $request)
    {
        // print_r(Session()->get('Login_Email')[0]->ID ); exit;
        // print_r($request->all()); 
        
        $request->validate([
            'name'=>'required',
            'APCode'=>'required',
            'mobile'=>'required',
            'address'=>'required'
        ]);

        $ID = Session()->get('Login_Email')[0]->ID;
        $name = $request->get('name');
        $mobile = $request->get('mobile');
        $address = $request->get('address');
        $APCode = Session()->get('Login_Email')[0]->APCode;
        $fullPath = $request->get('oldimage');

        if ($request->hasFile('upload')) {

            $request->validate([
                'upload' => 'required|image|mimes:png,jpg,jpeg'
            ]);

            $image = $request->file('upload');
            $destinationPath = 'assets/img/digital/';
            $profileImage = $APCode.".".$image->getClientOriginalExtension();
            $fullPath = $destinationPath.$profileImage;
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }
        // exit;
        
        $conn = DB::connection('sqlsrv');
        try{
            $res = $conn->select("UPDATE tbl_profile SET profile_pic = '$fullPath', mobile_no = '$mobile', name = '$name', Address = '$address' WHERE ID = $ID");
        } catch (\Exception $e) {
        }

        $res = $conn->select("SELECT * FROM tbl_profile WHERE ID = $ID");
        $request->Session()->put('Login_Email',$res);
            
        return redirect('edit_profile')->with('status',"Profile updated!");
    }
}
