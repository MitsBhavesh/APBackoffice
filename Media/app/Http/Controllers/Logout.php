<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
class Logout extends Controller
{
    public function index()
	{
		if(isset(Session()->get('Login_Email')[0]))
		{
			unset(Session()->get('Login_Email')[0]);
		}
	
		// session_destroy();
		return redirect('Login');
	}
}
