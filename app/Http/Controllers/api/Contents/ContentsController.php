<?php

namespace App\Http\Controllers\api\Contents;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
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
            return response()->json(APIHelper::returnNotFound('Nenhuma contato encontrada'), 404);
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
            'cod' => 'required',
            'name' => 'required',
            'date' => 'required',
            'cost' => 'required'
        ));

        if(!$validator->fails()){
            $content = $this->mainModel->newInstance();

            $content->cod = $request->input('cod');
            $content->name = $request->input('name');
            $content->date = $request->input('date');
            $content->cost = $request->input('cost');

            if ($content->save()) {
                return response()->json(APIHelper::returnSuccess($content), 200);
            } else {
                return response()->json(APIHelper::returnError('Erro ao salvar conteúdo'), 404);
            }

        }
        else{
            return response()->json(APIHelper::returnNotSaved($validator->errors()->toArray()), 404);
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
        $content = $this->mainModel->newQuery()
            ->find($id);

        if($content){
            return response()->json(APIHelper::returnSuccess($content), 200);
        }
        else{
            return response()->json(APIHelper::returnNotFound('Conteúdo não encontrada'), 404);
        }

        return response()->json(APIHelper::returnSuccess($content), 200);
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
            'cost' => 'required'
        ));

        if(!$validator->fails()){
            $content = $this->mainModel->newQuery()->where('id', $id)->first();

            if($content) {
                $content->cod = $request->input('cod');
                $content->name = $request->input('name');
                $content->date = $request->input('date');
                $content->cost = $request->input('cost');

                if ($content->save()) {
                    return response()->json(APIHelper::returnSuccess($content), 200);
                } else {
                    return response()->json(APIHelper::returnError('Erro ao salvar conteúdo'), 404);
                }
            }
            else{
                return response()->json(APIHelper::returnNotFound('Conteúdo não encontrada'), 404);
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
        $content = $this->mainModel->newQuery()->where('id', $id)->first();

        if($content->delete()){
            return response()->json(APIHelper::returnSuccess('Conteúdo removido'), 200);
        }
        else{
            return response()->json(APIHelper::returnNotFound('Conteúdo não removido'), 404);
        }
    }
}
