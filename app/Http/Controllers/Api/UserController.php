<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
class UserController extends Controller
{
    public function login(Request $request)
    {
    	request()->validate([
    		'email' => 'required',
    		'password' => 'required'
    	]);

    	$user = User::where('email', request('email'))->first();
    	if ($user && Hash::check(request('password'), $user->password)) {

    		return [
                'access_token' => $user->createToken('token_base_name')->plainTextToken,
                'exipres_at' => time() + 180
            ];
    	}

		return response()->json([
			'status' => 'error',
			'message' => 'رمز عبور یا ایمیل معتبر نمی باشد'
		]);

    }
}
