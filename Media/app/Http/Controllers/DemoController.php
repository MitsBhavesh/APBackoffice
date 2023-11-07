<?php

namespace App\Http\Controllers;

use App\Models\Arham_Data_Insert;
use Illuminate\Http\Request;
use Auth;
use Hash;
// use Illuminate\Support\Facades\Auth;
use Session;
use DB;

class DemoController extends Controller
{
    public function index(){
        $data = compact('url','title');
        // echo view('layouts/header');
        echo view('layouts/form',['data'=>$data]);
        // echo view('layouts/footer');
    }

    public function Insert(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required|unique:arhamreg|email',
                // 'password' => 'required|confirmed',
                'password' => 'required|min:8',
                'confirm_password' => 'required|same:password'
            ]
        );
        // echo "<pre>";
        // print_r($request->all()); exit;

        $arham = new Arham_Data_Insert;
        $arham->name = $request['name'];
        $arham->email = $request['email'];
        // $arham->password = \Hash::make($request['password']);
        // $arham->password = $request['password'];
        $arham->password =  Hash::make($request->password);
        $arham->confirm_password =  $request['confirm_password'];
        //md5() for Encode Password
        // $arham->confirm_password = md5($request['confirm_password']);
        // dd($arham);
        $arham->save();
        // return redirect()->back()->with('status','Data Added Successfully');
        return redirect('Login')->with('status_login','Data Added Successfully');
    }

    public function ShowData()
    {
        // $users = DB::select('select * from arhamreg');
        $users = Arham_Data_Insert::all();
        // print_r($users); exit;
        echo view('layouts/header');
        return view('layouts/show_data',['users'=>$users]);
    }

    public function Delete($id)
    {
        // echo $id; die;
        $Delete = Arham_Data_Insert::find($id);
        // Arham_Data_Insert::find($id)->delete();
        if(!is_null($Delete))
        {
            $Delete->delete();
            return redirect('/ShowData')->with('status','Data Deleted Successfully');
        }
        else{
            return redirect('/ShowData');
        }
    }

    public function edit($id)
    {
        $customer = Arham_Data_Insert::find($id);
        $data  = $customer->toArray();
        // echo "<pre>";
        // print_r($customer->toArray()); exit;
        if(is_null($customer))
        {
            // Not Found
            return redirect('layouts/update');
        }
        else{
            // Found
            $url = url('/Update') .'/'. $id;
            // print_r($url); exit;
            $title = 'Edit Page';
            // $data = Compact('customer');
            // $data = Compact('customer','url', 'title');
            // echo "<pre>";
            // print_r($data); exit;
            // return view('layouts/form')->with($data);
            return view('layouts/update',['data'=>$data]);
            // return view('layouts/form',['data'=>$data,'url'=>$url,'title'=>$title]);
        }
    }

    public function Update($id, Request $request)
    {
        // echo "nkj"; exit;
        $arham = Arham_Data_Insert::find($id);
        $arham->name = $request['name'];
        $arham->email = $request['email'];
        $arham->save();
        return redirect('/ShowData');
    }

    public function login()
    {
        // echo "hii";
        // echo view('layouts/header');
        echo view('layouts/login');
    }

    public function postLogin(Request $request)
    {
        if($request->all())
        {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);
          
            $Arham_Data_Insert = Arham_Data_Insert::where('email','=',$request->email)->first();
            // print_r($Arham_Data_Insert); exit;
          

            if ($Arham_Data_Insert)
            {
                if(Hash::check($request->password,$Arham_Data_Insert->password))
                {
                    // dd($Arham_Data_Insert->password);
                    $request->Session()->put('Login_Email',$Arham_Data_Insert->email);
                    $request->Session()->put('id',$Arham_Data_Insert->id);
                    return redirect('dashboard');
                }
                else
                {
                    // echo "bye1";
                    // exit;
                    return Back()->with('fail','sPassword is not Valid ...!');
                }
            }
            else
            {
                // echo "bye2";
                return Back()->with('fail','This email is not Register ...!');
            }
        }
    }

    public function dashboard()
    {
        $data = array();
        if(Session::has('Login_Email'))
        {
            $data = Arham_Data_Insert::where('email','=',Session::get('Login_Email'))->first();

        }
        echo view('layouts.header');
        return view('layouts.dashboard',compact('data'));
    }

    public function logout() {
        Session::flush();
        Auth::logout();
  
        return redirect('/')->with('status_logout','LoggedOut Successfully');
    }

}
