<?php
// use DB;
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\profile;
use Illuminate\Support\Facades\Storage;
class Add_image extends Controller
{
    public function index(){
        
        echo view('herder');
        echo view('add_image');  
        echo view('footer');
    } 
    public function insert(Request $request)
    {
        $R=[];
        $user = new profile();
        $user->name = $request->get('name');
        $user->mobile = $request->get('mobile');
        $user->APCode = $request->get('APCode');
        $user->Address = $request->get('Address');
        $user->image = $request->get('image');
      
            $R[] = Storage::disk('local')->append('file.txt', $user);
            
            return redirect('Add_image')->with('status',"Insert successfully");
            // DD($user->Address);
            // $user->save();
        
    }
  

    public function viewrecord()
    {
        // $pancard = $_POST['pancard'];
		$arrayMrg = [];
        $res = file("Storage/app/file.txt") or die("Unable to open file!");

		if(isset($res))
		{

            $myObj = new stdClass();
            $myObj->RowId = $res[0]['name'];
            $myObj->Pan = $res[0]['mobile'];
            $myObj->Name = $res[0]['APCode'];
            $myObj->Dob = $res[0]['address'];
            
            $myObj->PanProof = "";
			if(file_exists($res[0]['image'])) 
            {
				$myObj->PanProof = base64_encode(file_get_contents($res[0]['image']));
				// $myObj->PanProof = base64_encode(file_get_contents($res[0]['PanProof']));
			}

			
				$arrayMrg[0] = $myObj;
				// print_r($arrayMrg); exit();
				echo json_encode($arrayMrg);
			    exit();
        }        
        echo view('herder');         
        echo view('viewrecore',['user'=>$user]);  
        echo view('footer');
    } 

      
}
