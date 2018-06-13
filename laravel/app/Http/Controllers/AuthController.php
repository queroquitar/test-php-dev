<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use \JWTAuth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function authenticate(Request $request) {
    
        $user = User::where('email', $request->input('email'))->first();
        
        if (!$user)
            return ['error' => "Usuario não encontrado"];
  
        if (!Hash::check($request->input('password'), $user->password))
            return ['error' => "Usuario e/ou senha incorreto"];
  
        $token = JWTAuth::fromUser($user);
  
        $objectToken = JWTAuth::setToken($token);
  
        return [
          'access_token' => $token
        ];
    }
}
