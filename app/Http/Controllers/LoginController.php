<?php

namespace App\Http\Controllers;

use App\Helper\CustomController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LoginController extends CustomController
{
    public function index(){
        if (\request()->isMethod('POST')){
            return $this->login();
        }
        return view('auth.login');
    }

    public function login(){
        $field = \request()->validate(
            [
                'username' => 'required|string',
                'password' => 'required|string',
            ]
        );
//            $user = User::where('username', $field['username'])->first();
//            if ($user && Hash::check($field['password'], $user->password)){
//                return redirect('/admin');
//            }
        if ($this->isAuth($field)) {
            $role = \auth()->user()->role;
            if ($role == 'pimpinan'){
                $role = 'admin';
            }
            $redirect = "/$role";

//            return response()->json();

            return redirect($redirect);
        }
        return Redirect::back()->withErrors(['pasword' => 'Password mismach.'])->with(['username' => request('username')]);
    }

    public function logout(){
        Auth::logout();
        return \redirect('/');
    }

}
