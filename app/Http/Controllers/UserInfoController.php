<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use PhpParser\Builder;
use function Sodium\add;

class UserInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function find(Request $request){
        $users = DB::table('users');
        if($request->has('user_id')){
            $users = $users->where('id','LIKE',$request->input('user_id'));
        }
        if($request->has('phone_number')){
            $users = $users->where('phone_number','LIKE',$request->input('phone_number'));
        }
        if($request->has('user_name')){
            $users = $users->where('user_name','LIKE',$request->input('user_name'));
        }
        $users = $users->select('user_name','name','phone_number','role','is_active')
            ->paginate(5);
        return view('userinfo/find',compact(['users']));
    }

    public function find_phone_role(Request $request){
        $user_id = $request->input('user_id');
        $phone = $request->input('phone');
        $role_name = $request->input('role_name');
        DB::enableQueryLog(); // Enable query log


        //store user_id which have user_id, role in condition
        $user_collection = collect([]);

        //select users which have user_id
        if($role_name!=''){
            $users = \App\User::where('id','LIKE',$user_id)->get();
            foreach ($users as $user){
                //get list_users which have role_name in condition relate each user in users
                $role_names =  $user->role()->ofName($role_name)->select('role_user.user_id')
                    ->get();
                foreach ($role_names as $role_name_table){
                    //get user_id which in list_users behind and push to collection
                    $user_collection->push($role_name_table->user_id) ;
                }
            }
        }else{
            $user_collection = collect([\App\User::where('id','LIKE',$user_id)->pluck('id')]);
        }


        if($phone!=''){
            $user_roles_phones = \App\User::whereIn('id',$user_collection)->get();
            $user_collection = collect([]);
            foreach ($user_roles_phones as $user){
                $user_phones = $user->phone()->ofNumber($phone)->select('user_id')->get();
                foreach ($user_phones as $user_phone){
                    $user_collection->push($user_phone->user_id) ;
                }
            }
        }

        $user_collection = $user_collection->unique();

        $ans = DB::table('users')->leftJoin('phones','users.id','=','user_id')
                ->leftJoin('role_user','users.id','=','role_user.user_id')
                ->leftJoin('roles','roles.id','=','role_user.role_id')
                ->whereIn('users.id',$user_collection)
                ->select('users.id','users.first_name','users.last_name','phones.number','roles.name')
                ->paginate(5);

        return view('userinfo/find-phone-role',compact(['ans']));
    }
}
