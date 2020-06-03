<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    function checkLogin(Request $request){
        $request->validate([
            'sdt'=>'required',
            'password'=>'required',
        ],['sdt.required' => 'Phone number is required','password.required'=> 'Password is required']);
        return redirect('');
    }

}
