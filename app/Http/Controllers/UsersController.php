<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Users as Users;
use Validator;

class UsersController extends Controller{
    
    public function aunthenticate(Request $request){

        $login = $request -> input('login');
        $password = $request -> input('password');

    	Auth::attempt(['name' => $login, 'password' => $password]);

        return back()->withInput()->withErrors('Invalid login or password');
    }

    public function create(Request $request){

        $login = $request -> input('login');
        $password = $request -> input('password');
        $email = $request -> input('email');

        $validate = Validator::make($request->all(), [
            'login' => 'required|max:20|unique:users,name',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
        ]);

        if($validate->fails()){

            return back()->withInput()->withErrors($validate -> messages());
        }

        Users::create(['name' => $login,
                    'password' => bcrypt($password),
                    'email' => $email]);

        Auth::attempt(['name' => $login,
                    'password' => $password]);

        return redirect('dashboard');
    }

    public function viewDashboard(){

        $userPastes = Users::getDashboardData();

    	return view('dashboard', compact('userPastes'));
    }

    public function logout(){

        Auth::logout();
        
        return redirect('/');
    }
}
