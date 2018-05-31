<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
        $contents = array();

        $response = Curl::to(env('API_HOST') . 'contents')
            ->withHeader('Authorization: Bearer ' . Auth::user()->jwt)
            ->asJson(true)
            ->get();

        if(isset($response['status']) && $response['status'] == 'success'){
            $contents = $response['data'];
        }

        return view('contents.index',
            compact(
                'contents'
            )
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $content = array();

        $response = Curl::to(env('API_HOST') . 'contents/' .$id)
            ->withHeader('Authorization: Bearer ' . Auth::user()->jwt)
            ->asJson(true)
            ->get();

        if(isset($response['status']) && $response['status'] == 'success'){
            $content = $response['data'];
        }

        return view('contents.edit',
            compact('content')
        );
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
            'cod' => 'required',
            'name' => 'required',
            'date' => 'required',
            'cost' => 'required',
        ));

        if (!$validator->fails()) {
            $data = $request->only(['cod', 'name', 'date', 'cost']);
            $data['date'] = !empty($data['date'])?Carbon::createFromFormat('d/m/Y', $data['date'])->format('Y-m-d'):'';
            $data['cost'] = Helper::castMoneyRealToDecimal($data['cost']);

            $response = Curl::to(env('API_HOST') . 'contents/'.$id)
                ->withHeader('Authorization: Bearer ' . Auth::user()->jwt)
                ->withData($data)
                ->asJson(true)
                ->put();

            if (isset($response['status']) && $response['status'] == 'success') {
                $request->session()->flash('alert-success', 'Conteúdo alterado');
                return redirect()->route('contents.index');
            }
        }
        else{
            $request->session()->flash('alert-danger', Helper::formatFormErrorMsg($validator->errors()->messages()));
            return redirect()->route('contents.edit', [$id]);
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
        $response = Curl::to(env('API_HOST') . 'contents/' .$id)
            ->withHeader('Authorization: Bearer ' . Auth::user()->jwt)
            ->asJson(true)
            ->delete();

        if(isset($response['status']) && $response['status'] == 'success'){
            die('1');
        }

        die('0');
    }
}
