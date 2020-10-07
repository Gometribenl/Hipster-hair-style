<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
                return response()->json(['status' => 400, 'message' => 'Wrong email or password']);
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
        $objNewUser = new User();
        $objNewUser->first_name = $request->input('first_name');
        $objNewUser->last_name = $request->input('last_name');
        $objNewUser->email = $request->input('email');
        $objNewUser->password = $request->input('password');
        $objNewUser->phonenumber = $request->input('phonenumber');
        $objNewUser->save();

    }

}
