<?php
namespace App\Http\Controllers;
use App\MemberInsert;
use Illuminate\Http\Request;
use \Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
class MemberInsertController extends Controller
{
    
    public function insert(){
        $urlData = getURLList();
        return view('Member_create');
    }
    public function create(Request $request){
        $rules = [
         'profile_nm' => 'required|string|min:3|max:255',
         'full_address' => 'required|string|min:3|max:255',
         'email' => 'required|string|email|max:255'
      ];
      $validator = Validator::make($request->all(),$rules);
      if ($validator->fails()) {
         return redirect('insert')
         ->withInput()
         ->withErrors($validator);
      }
      else{
            $data = $request->input();
         try{
            $member = new MemberInsert;
                $member->profile_nm = $data['profile_nm'];
                $member->real_nm = $data['real_nm'];
            $member->full_address = $data['full_address'];
            $member->email = $data['email'];
            $member->save();
            return redirect('insert')->with('status',"Insert successfully");
         }
         catch(Exception $e){
            return redirect('insert')->with('failed',"operation failed");
         }
      }
    }
}