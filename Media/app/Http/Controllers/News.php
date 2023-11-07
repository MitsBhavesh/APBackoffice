<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class News extends Controller
{
    public function index(){

        $curl = curl_init();
			$agent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)';
			curl_setopt_array($curl, array(
			  CURLOPT_URL => 'https://newsapi.org/v2/top-headlines?country=in&category=business&apiKey=dba26aec8c7148e08962967083622b44',
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'GET',
			  CURLOPT_USERAGENT=>$agent,
			));

			$response = curl_exec($curl);

			curl_close($curl);
			
			$array=json_decode($response,true);
            $user = $array['articles'];
			// echo "<pre>";
			// print_r($array['articles']);
			// exit();

        echo view('herder');
        echo view('news',['user'=>$user]);  
        echo view('footer');
    } 
}
