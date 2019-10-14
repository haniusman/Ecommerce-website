<?php

namespace App\Http\Controllers;

use App\Country;
use App\User;
use DB;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UsersController extends Controller
{
    public function userLoginRegister()
    {
        return view('users.login_register');
    }

    public function register(Request $request)
    {
        if($request->isMethod('post'))
        {
            $data = $request->all();
//            print_r($data);die;
            $usersCount = User::where('email',$data['email'])->count();
            if($usersCount > 0)
            {
                return redirect()->back()->with('error','Email already exists!');
            }else{
                $user = new User();
                $user->name = strip_tags($data['name']);
                $user->email = strip_tags($data['email']);
                $user->password = bcrypt($data['password']);

                $user->save();
                if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']]))
                {
                    Session::put('frontSession',$data['email']);
                    return redirect('cart');
                }
            }
        }
        return view('users.login_register');
    }

    public function checkEmail(Request $request)
    {
        $data = $request->all();
        $usersCount = User::where('email',$data['email'])->count();
        if($usersCount > 0)
        {
            echo "false";
        }else{
            echo "true";
            die;
        }
    }

    public function login(Request $request)
    {
        if($request->isMethod('post'))
        {
            $data = $request->all();
            if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']]))
            {
                Session::put('frontSession',$data['email']);

                if(!empty(Session::get('session_id')))
                {
                    $session_id = Session::get('session_id');
                    DB::table('cart')->where('session_id',$session_id)->update(
                        [
                            'user_email' => $data['email']
                        ]
                    );

                }
                return redirect('/cart');
            }else{
                return redirect()->back()->with('error','Invalid username or password!');
            }
        }
    }

    public function account(Request $request)
    {
        $user_id = Auth::user()->id;
        $user_details = User::find($user_id);
        $countries = Country::get();

        if($request->isMethod('post'))
        {
            $data = $request->all();

            if(empty($data['name']))
            {
                return redirect()->back()->with('update_message','Please enter your name to update account details!');
            }
            if(empty($data['address']))
            {
               $data['address'] = '';
            }
            if(empty($data['city']))
            {
                $data['city'] = '';
            }
            if(empty($data['province']))
            {
                $data['province'] = '';
            }
            if(empty($data['country']))
            {
                $data['country'] = '';
            }
            if(empty($data['pincode']))
            {
                $data['pincode'] = '';
            }
            if(empty($data['mobile']))
            {
                $data['mobile'] = '';
            }

            User::where(['id'=>$user_id])->update(
                [
                    'name' => strip_tags($data['name']),
                    'address' => strip_tags($data['address']),
                    'city' => strip_tags($data['city']),
                    'province' => strip_tags($data['province']),
                    'country' => $data['country'],
                    'pincode' => strip_tags($data['pincode']),
                    'mobile' => strip_tags($data['mobile'])
                ]
            );
            return redirect()->back()->with('update_message','Your account details have been updated successfully!');

        }
        return view('users.account')->with(compact('countries','user_details'));
    }

    public function chkUserPassword(Request $request)
    {
        $data = $request->all();
//            echo"<pre>";print_r($data);die;

        $current_pwd = $data['current_pwd'];
        $user_id = Auth::User()->id;
        $check_password =  User::where(['id'=>$user_id])->first();
        if(Hash::check($current_pwd , $check_password->password)){
            echo"true";
            die;
        }else{
            echo "false";
            die;
        }
    }

    public function updatePassword(Request $request)
    {
        if($request->isMethod('post'))
        {
            $data = $request->all();
            $old_password = User::where(['id'=>Auth::User()->id])->first();
            if(Hash::check($data['current_pwd'] , $old_password->password))
            {
                $new_password = bcrypt($data['new_pwd']);
                User::where('id',Auth::User()->id)->update(['password'=>$new_password]);
                return redirect()->back()->with('update_message','Password updated succcessfully!');
            }else{
                return redirect()->back()->with('error','Current password is incorrect!');
            }
        }
    }

    public function logout()
    {
        Auth::logout();
        Session::forget('frontSession');
        Session::forget('session_id');
        return redirect('/');
    }
}
