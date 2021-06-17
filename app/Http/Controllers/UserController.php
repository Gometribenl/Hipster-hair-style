<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
//use Illuminate\Routing\Controller;


class UserController extends Controller
{
     /**
     *
     *  Login function
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     **/
    public function login(Request $request)
    {
        $validator = $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
        if (!$validator) {
            return response()->json(['status' => 400, 'message' => 'Invalid email or password']);
        } else {
            $userdata = [
                'email' => $request->email,
                'password' => $request->password,
            ];

            //attempt to authenticate. Returns true or false
            if (!Auth::attempt($userdata)) {
                return response()->json(['status' => 400, 'message' => 'Wrong email or password',$userdata]);
            } else if (Auth::attempt($userdata)) {
                $user = User::where('email', $request->email)->first();
                if(Hash::check($request->password, $user->password)) {
                    return response()->json(['status' => 200, 'message' => 'Logged in!', 'user' => $user]);
                } else {
                    return response()->json(['status' => 400, 'message' => 'Wrong password']);
                }
            }
        }
        return response()->json(['status' => 400, 'message' => 'Invalid email or password']);
    }


    /**
     * Register a user
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'phonenumber'=> 'required|min:4',
            'first_name'=>'required|min:2',
            'last_name'=> 'required|min:2',
        ]);
        $user= $request->all();
        $user['password'] = Hash::make($request->password);
        User::create($user);
    }

}
