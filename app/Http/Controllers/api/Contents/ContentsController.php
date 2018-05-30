<?php

namespace App\Http\Controllers\api\Contents;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\APIHelper;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use JWTFactory;
use JWTAuth;
use Response;

use App\Models\Content;

class ContentsController extends Controller
{
    protected $mainModel;

    public function __construct(Content $mainModel)
    {
        $this->mainModel = $mainModel;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contents = $this->mainModel->newQuery()->get();

        if($contents->count()) {
            return response()->json(APIHelper::returnSuccess($contents), 200);
        } else {
            return response()->json(APIHelper::returnNotFound('Nenhuma usuário encontrada'), 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), array(
            'email' => 'email|required|min:5|unique:users,email,NULL,id',
            'password' => 'required|min:6'
        ));

        if(!$validator->fails()){
            $user = $this->mainModel->newInstance();
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));

            if($user->save()) {
                return response()->json(APIHelper::returnSuccess($user), 200);
            }
            else{
                return response()->json(APIHelper::returnError('Erro ao salvar usuário'), 404);
            }
        }
        else{
            return response()->json(APIHelper::returnNotSaved($validator->errors()->toArray()), 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), array(
            'email' => 'email|required|min:5|unique:users,email,NULL,id',
            'password' => 'required|min:6'
        ));

        if(!$validator->fails()){
            $user = $this->mainModel->newInstance();
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));

            if($user->save()) {
                $token = JWTAuth::fromUser($user);
                return response()->json(APIHelper::returnSuccess(compact('token')), 200);
            }
            else{
                return response()->json(APIHelper::returnError('Erro ao salvar usuário'), 404);
            }
        }
        else{
            return response()->json(APIHelper::returnNotSaved($validator->errors()->toArray()), 404);
        }
    }

    /**
     * Login
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password'=> 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $credentials = $request->only('email', 'password');
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(APIHelper::returnNotFound('Credenciais inválidas'), 401);
            }
        } catch (JWTException $e) {
            return response()->json(APIHelper::returnNotFound('Credenciais inválidas'), 500);
        }
        return response()->json(compact('token'));
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(APIHelper::returnSuccess(Auth::user()), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->mainModel->newQuery()
            ->find($id);

        if($user){
            return response()->json(APIHelper::returnSuccess($user), 200);
        }
        else{
            return response()->json(APIHelper::returnNotFound('Usuário não encontrada'), 404);
        }

        return response()->json(APIHelper::returnSuccess($user), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), array(
            'email' => 'email|required|min:5|unique:users,email,'.$id,
        ));

        if(!$validator->fails()){
            $user = $this->mainModel->newQuery()->where('id', $id)->first();

            if($user) {
                $user->id = $id;
                $user->email = $request->input('email');
                $user->password = Hash::make($request->input('password'));

                if ($user->save()) {
                    return response()->json(APIHelper::returnSuccess($user), 200);
                } else {
                    return response()->json(APIHelper::returnError('Erro ao salvar usuário'), 404);
                }
            }
            else{
                return response()->json(APIHelper::returnNotFound('Usuário não encontrada'), 404);
            }
        }
        else{
            return response()->json(APIHelper::returnNotSaved($validator->errors()->toArray()), 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
