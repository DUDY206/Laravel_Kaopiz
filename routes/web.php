<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login',function(){
    return view('pages/login');
});
Route::post('/login','LoginController@checkLogin');

Route::get('/userinfo/{userid}',function($userid){
    return view('userinfo/show')->with('userid',$userid);
});


//User query buider test
Route::get('users/create',function (){
    for($i = 0;$i<10;$i++){
        DB::table('users')->insert([
            [
                'user_name'=>'temp'.$i,
                'name'=>'temp'.$i,
                'phone_number'=>(string)$i,
                'password'=>Hash::make('password'),
                'is_active'=>'1',
                'role'=>'role_temp',
            ]
        ]);
    }
});

Route::get('users/update',function (){
    DB::table('users')->where('phone_number','0')->update(['phone_number'=>'0123456789']);
});

Route::get('users/delete',function (){
    DB::table('users')->where('phone_number','1')->delete();
});

Route::get('users/get',function (){
    $users = DB::table('users')->get();
    dd($users);
});

Route::get('users/select',function (){
    $users = DB::table('users')->select('user_name','role','created_at')->get();
    dd($users);
});


//Product query buider test
//Route::get('products/create',function (){
//    for($i = 0;$i<5;$i++){
//        DB::table('products')->insert([
//            [
//                'name'=>'temp_'.$i,
//                'quantity'=>'10000',
//            ]
//        ]);
//    }
//});
//Route::get('product_receipt/create',function (){
//    for($i = 0;$i<5;$i++){
//        DB::table('products-receipt')->insert([
//            [
//                'product_id'=>$i+1,
//                'amount'=>'0',
//                'receipt_price'=>'50000',
//                'receipt_date'=>Carbon::now()->format('Y-m-d')
//            ]
//        ]);
//    }
//});

//Query builder Join
Route::get('join',function (){
    $product = DB::table('products')->join('products-receipt','product_id','=','products.id')->select
    ('products.name','products-receipt.amount')->get();
    dd($product);
});

//Query builder where
Route::get('where',function (){
   $product = DB::table('products')->where('name','LIKE','%3')->get();
   dd($product);
});
