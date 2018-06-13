<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function get($id = null)
    {
        if($id){
            $user = User::find($id);
            if($user){
                return ['data' => User::find($id) ,"code"=>0];
            }
            return ['data' => null ,"code"=>1];
        }
        return ['data' => User::all() ,"code"=>0];        
    }

    public function post(Request $request)
    {
        $id = $request->input('id');
        $email = $request->input('email');
        $password = $request->input('password');
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            return ['data' => null ,"code"=>"Email inválido"];
        if (strlen($password) < 4)
            return ['data' => null ,"code"=>"Senha menor que 4 digitos"];
        
        $user = User::where('email',$email)->first();
        if($user){
            return ['data' => null ,"code"=>"Email já cadastrado"];    
        }
        
        if($id){
            User::where('id', $id)
                ->update([
                    'email' => $email,
                    'password' => bcrypt($password)
                ]);
        }else{
            User::insert([
                'email' => $email,
                'password' => bcrypt($password)
            ]);
        }
        
        return ['data' => User::where('email',$email)->first() ,"code"=>0];
    }

    public function delete($id)
    {
        $user = User::find($id);
        if($user){
            $user->delete();
            return ['data' => null,"code"=>0];
        }
        return ['data' => null,"code"=>"User não encontrado"];
    }

}
