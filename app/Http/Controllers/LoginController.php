<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    function checkLogin(Request $request){
//        $this->validate($request,[
//            'sdt' => 'required',
//            'password' => 'required',
//        ]);
//        $token = '123';
        return redirect('?token=123');
    }

}
