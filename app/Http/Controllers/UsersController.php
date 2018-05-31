<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Helper;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\User;

class UsersController extends Controller
{
    protected $mainModel;

    public function __construct(User $mainModel)
    {
        $this->mainModel = $mainModel;
    }

    /**
     * Login
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function login(){
        return view('login');
    }

    /**
     * Realiza Login
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function doLogin(Request $request){
        $credentials = $request->only('email', 'password');

        $response = Curl::to(env('API_HOST') . 'users/login')
            ->withData( $credentials )
            ->asJson( true )
            ->post();

        if(isset($response['token'])){
            if (Auth::attempt($credentials)) {
                $user = $this->mainModel->newQuery()->where('email', $credentials['email'])->first();
                $user->jwt = $response['token'];
                $user->save();
                Auth::setUser($user);
                return redirect()->intended('home');
            }
            else{
                $request->session()->flash('alert-danger', 'Usuário e Senha inválidos');
                return back()->withInput();
            }
        }
        else{
            $request->session()->flash('alert-danger', 'Usuário e Senha inválidos');
            return back()->withInput();
        }
    }

    /**
     * Logout
     *
     */
    public function logout(){
        Auth::logout();
        return redirect(route('users.login'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
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
            'password' => 'confirmed|min:6'
        ));

        if (!$validator->fails()) {
            $data = $request->only(['email', 'password']);

            $response = Curl::to(env('API_HOST') . 'users')
                ->withData($data)
                ->asJson(true)
                ->post();

            if(isset($response['status']) && $response['status'] == 'success'){
                $request->session()->flash('alert-success', 'Usuário cadastrado');
                return redirect()->route('login');
            }
        }
        else{
            $request->session()->flash('alert-danger', Helper::formatFormErrorMsg($validator->errors()->messages()));
            return redirect()->route('users.create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = array();

        $response = Curl::to(env('API_HOST') . 'users/'.$id)
            ->withHeader('Authorization: Bearer ' . Auth::user()->jwt)
            ->asJson( true )
            ->get();

        if(isset($response['status']) && $response['status'] == 'success'){
            $user = $response['data'];
        }

        return view('users.edit', compact(
            'user'
        ));
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
            'password' => 'confirmed|min:6'
        ));

        if (!$validator->fails()) {
            $data = $request->only(['password']);
            $data['email'] = Auth::user()->email;

            $response = Curl::to(env('API_HOST') . 'users/'.$id)
                ->withHeader('Authorization: Bearer ' . Auth::user()->jwt)
                ->withData($data)
                ->asJson(true)
                ->put();

            if(isset($response['status']) && $response['status'] == 'success'){
                $request->session()->flash('alert-success', 'Senha alterada');
                return redirect()->route('users.edit', [$id]);
            }
        }
        else{

            $request->session()->flash('alert-danger', Helper::formatFormErrorMsg($validator->errors()->messages()));
            return redirect()->route('users.edit', [$id]);
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
        //
    }
}
