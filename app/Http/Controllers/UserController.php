<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Hash;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = DB::table('users')->get();
        $userid = session()->get( 'userid');
        $username = session()->get( 'username');
        $useremail = session()->get( 'useremail');
       return view('users.users_list',compact('users','userid','username','useremail'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userid = session()->get( 'userid');
        $username = session()->get( 'username');
        $useremail = session()->get( 'useremail');
        return view('users.user_add',compact('userid','username','useremail'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|min:3|max:50',
            'email' => 'required|email',
            'password' => 'min:6|required_with:r_password|same:r_password',
            'r_password' => 'min:6',
            'admin' => 'required'
        ]);
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
    {   // return view('welcome');
        $userid = session()->get( 'userid');
        $username = session()->get( 'username');
        $useremail = session()->get( 'useremail');

         $users = DB::table('users')->where('id','=',$id)->first();
         return view('users.user_edit',compact('users','userid','username','useremail'));
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
        //return view('welcome');
        $data = [
            'name' => $request->name,
            'email'=>$request->email,
            'updated_at'=>date ('Y-m-d H:i:s')
        ];
        DB::table('users')->where('id','=',$id)->update($data);
        return redirect('admin1/userslist')->with("update_message","Record updated succesfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Db::table('users')->where('id','=',$id)->delete();
        return redirect('admin1/userslist')->with("update_message","Record deleted successfully");

    }
}
