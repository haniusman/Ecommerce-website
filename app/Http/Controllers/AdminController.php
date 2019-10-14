<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Admin;
use Illuminate\Http\Request;
use Auth;
use Session;
use DB;
class AdminController extends Controller
{
    public function login(Request $request)
    {

        if($request->isMethod('post'))
        {
            $data = $request->input();
            /*$request->validate([
                'email' => 'required|unique:users,email|max:255',
                'password' => 'required|min:6',
            ]);*/
//           echo $adminCount = Admin::where(['username'=>$data['username'],'password'=>$data['password'],'status'=>1])->count(); die;


            if(Auth::attempt(['email'=>$request->email,'password' => $request->password]))
            {
                Session::put('adminSession',$data['email']);
                $users = DB::table('users')->where('email','=',$data['email'])->first();

                session()->put('userid',$users->id);
                session()->put('username',$users->name);
                session()->put('useremail',$users->email);
                //dd(Session::all());
                return redirect('/admin1/dashboard');
                //return redirect::action('AdminController@dashboard');
            }
            else{
               // echo "Failed";die;
                return redirect('/admin1')->with('flash_message_error','Invalid Username or Password');
            }
        }
        return view('admin.admin_login');
    }
    public function register(){
        return view('admin.admin_register');
    }

    public function store(Request $request)
    {
        $data = [
            'name' => $request->input('name'),
            'email'=>$request->input('email'),
            'password'=>$request->input('password'),
            'created_at'=> date('Y-m-d H:i:s')
        ];
        // print_r($data);
        DB::table('users')->insert($data);
    }
    public function dashboard()
    {
        //protected access with sessions

        if(Session::has('adminSession'))
        {
           // $k = session()->get('adminSession');
           // $users = DB::table('users')->where('email','=',$k)->first();
           // return view('admin.dashboard',compact('users'));
        }
        else
        {
            return redirect('/admin1')->with('flash_message_error','Please login to access');
        }
        $userid = session()->get( 'userid');
        $username = session()->get( 'username');
        $useremail = session()->get( 'useremail');

        return view('admin.dashboard',compact("username","userid","useremail"));
    }
    public function settings()
    {
        return view('admin.settings');
    }

    public function logout(){
        Session::flush();
        return redirect('/admin1')->with('flash_message_success','Logged Out Successfully');
    }
}
