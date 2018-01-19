<?php

namespace App\Http\Controllers;


use JWTAuth;
use App\User;
use Hash, Validator;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Password;


class ApiAuthController extends Controller
{
    /**
     * @api {post} api/register register
     * @apiName register
     * @apiGroup Login
     *
     * @apiParam {name} user name.
     * @apiParam {email} user email.
     * @apiParam {password} user password.
     *
     * @apiSuccess {Boolean} status  Response status.
     * @apiSuccess {String} message  Informative message.
     *
     * @apiVersion 1.0.0
     */
    public function register(Request $request)
    {
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ];

        $input = $request->only(
            'name',
            'email',
            'password',
            'password_confirmation'
        );

        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            $error = $validator->messages()->toJson();
            return response()->json(['success' => false, 'error' => $error]);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json(['success' => true, 'message' => 'Parabéns! você está cadastrado no sistema.']);
    }

    /**
     * @api {post} api/login login
     * @apiName login
     * @apiGroup Login
     *
     * @apiParam {email} user email.
     * @apiParam {password} user password.
     *
     * @apiSuccess {Boolean} status  Response status.
     * @apiSuccess {String} message  Informative message.
     *
     * @apiVersion 1.0.0
     */
    public function login(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];

        $input = $request->only('email', 'password');
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            $error = $validator->messages()->toJson();
            return response()->json(['success' => false, 'error' => $error]);
        }

        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['success' => false, 'error' => 'Informação invalida, por gentileza verifique seus dados de login e tente novamente.'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['success' => false, 'error' => 'Não foi possível criar o token. Por favor, contate o administrador do sistema.'], 500);
        }

        return response()->json(['success' => true, 'data' => ['token' => $token]]);
    }


    /**
     * @api {post} api/logout logout
     * @apiName logout
     * @apiGroup Login
     *
     * @apiParam {token} user token.
     *
     * @apiSuccess {Boolean} status  Response status.
     * @apiSuccess {String} message  Informative message.
     *
     * @apiVersion 1.0.0
     */
    public function logout(Request $request)
    {
        $this->validate($request, ['token' => 'required']);

        try {
            JWTAuth::invalidate($request->input('token'));
            return response()->json(['success' => true]);
        } catch (JWTException $e) {
            return response()->json(['success' => false, 'error' => 'Não foi possivel efetuar o logout, tente novamente ou contate o administrador do sistema.'], 500);
        }
    }
}
