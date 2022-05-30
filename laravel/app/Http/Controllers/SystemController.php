<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\SystemUser;
use Session;
use Auth;
use Hash;

class SystemController extends Controller
{

    // Admin user login
    public function login(Request $req)
    {
        $user = SystemUser::where('email', $req->email)->first();

        if($user)
        {
            if(Hash::check($req->password, $user->password))
            {
                unset($user->password);
                Session::put('user', $user->email);
                return response()->json("Login successful", 200);
            }
        }   
    
        return response()->json("Invalid username or password", 401);
    }


    // Register a new User
    public function register(Request $req)
    {
        $user = new SystemUser();
        $user->name = $req->name;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $res = $user->save();

        if($res)
        {
            return response()->json("Registration was successful", 200);
        }
        
        return response()->json("An error has occurred during registration", 400);
    }
    


    // Clear session and redirect to login page
    public function logout(Request $req)
    {
        Session::forget('user');
        return redirect('/');
    }

}