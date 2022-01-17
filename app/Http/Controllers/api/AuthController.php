<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
   public function login (Request $request){
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',

    ]);

    $user =  User::with('roles')->where('email', $request->email)->first();

    if (! $user || !  Hash::check($request->password, $user->password)) {
        throw  ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    return
    [
        'token' => $user->createToken($request->email)->plainTextToken,
        'user' => $user
    ];


   }
}
