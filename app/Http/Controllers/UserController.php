<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use App\Models\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;


class UserController extends Controller
{


    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'first_name' => 'required|max:255',
            'middle_name' => 'nullable|max:255',
            'last_name' => 'required|max:255',
            'employee_id' => 'required',
            'contact_number' => 'required|numeric',
            'course_program' => 'required|max:255',
            'password' => 'required'
        ]);
        $user = new User([
            'email' => $request->name,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'employee_id' => $request->employee_id,
            'contact_number' => $request->contact_number,
            'course_program' => $request->course_program,
            'password' => Hash::make($request->password)
        ]);
        $user->save();
        return response()->json(['message' => 'Success'], 200);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request('email', 'password');

        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $user = $request->user();
        $tokenResult = $user->createToken('personal Access Token');
        $token = $tokenResult->token;
        $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();


        return response()->json(['data' => [
            'user' => Auth::user(),
            'access_token' => $tokenResult->access_token,
            'token_type' => 'bearer',
            'expires_at' => carbon::parse($tokenResult->token->expires_at)->toDateTimeString()
        ]]);
    }

    public function logout()
    {
        Auth::logout();
        return response()->json(['message' => 'Logged out'], 200);
    }
    public function user()
    {
        return response()->json(Auth::user(), 200);
    }
}
