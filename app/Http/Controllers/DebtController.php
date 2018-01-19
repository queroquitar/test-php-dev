<?php

namespace App\Http\Controllers;

use App\Debt;
use Validator;
use Illuminate\Http\Request;

class DebtController extends Controller
{
    /**
     * @api {get} api/debts/all all
     * @apiName all
     * @apiGroup Debts
     *
     * @apiSuccess {Json} debts  All debts.
     *
     * @apiVersion 1.0.0
     */
    public function all()
    {
        return response()->json(['success' => true, 'data' => Debt::all()]);
    }

    /**
     * @api {get} api/debt/id debt
     * @apiName get
     * @apiGroup Debts
     *
     * @apiParam {id} debt id.
     *
     * @apiSuccess {Json} debt  specific debt.
     *
     * @apiVersion 1.0.0
     */
    public function get($id)
    {
        return json_encode(Debt::find($id));
    }


    /**
     * @api {get} api/debt/delete/id debt
     * @apiName delete
     * @apiGroup Debts
     *
     * @apiParam {id} debt id.
     *
     * @apiSuccess {Boolean} status  Response status.
     *
     * @apiVersion 1.0.0
     */
    public function destroy($id)
    {
        return json_encode(Debt::destroy($id));
    }


    /**
     * @api {post} api/debt/save debt
     * @apiName save
     * @apiGroup Debts
     *
     * @apiParam {name} debt name.
     * @apiParam {date} debt date.
     * @apiParam {value} debt value.
     * @apiParam {phone} debt phone.
     *
     * @apiSuccess {Boolean} status  Response status.
     * @apiSuccess {String} message  Informative message.
     *
     * @apiVersion 1.0.0
     */
    public function create(Request $request)
    {
        $validator = $this->validation($request);

        if ($validator) {
            $debt = new Debt();
            $debt->name = $request->name;
            $debt->date = $request->date;
            $debt->value = $request->value;
            $debt->phone = $request->phone;
            $debt->save();

            return response()->json(['success' => true, 'message' => 'Parabéns! cadastrado no sistema.']);

        }
        $error = $validator->messages()->toJson();
        return response()->json(['success' => false, 'error' => $error]);
    }

    /**
     * @api {post} api/debt/update/id debt
     * @apiName update
     * @apiGroup Debts
     *
     * @apiParam {id} debt id.
     * @apiParam {name} debt name.
     * @apiParam {date} debt date.
     * @apiParam {value} debt value.
     * @apiParam {phone} debt phone.
     *
     * @apiSuccess {Boolean} status  Response status.
     * @apiSuccess {String} message  Informative message.
     *
     * @apiVersion 1.0.0
     */
    public function update(Request $request, $id)
    {
        $validator = $this->validation($request);

        if ($validator) {
            $debt = Debt::find($id);
            $debt->name = $request->name;
            $debt->date = $request->date;
            $debt->value = $request->value;
            $debt->phone = $request->phone;
            $debt->save();

            return response()->json(['success' => true, 'message' => 'Parabéns! atualizado no sistema.']);

        }
        $error = $validator->messages()->toJson();
        return response()->json(['success' => false, 'error' => $error]);
    }

    /**
     * Faz a validação da classe de debitos.
     *
     * @param Request $request
     * @return bool
     */
    protected function validation(Request $request)
    {
        $rules = [
            'name' => 'required|max:255',
            'date' => 'required|max:255',
            'value' => 'required|max:255',
            'phone' => 'required|max:255',
        ];

        $input = $request->only(
            'name',
            'date',
            'value',
            'phone'
        );

        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return $validator;
        }

        return true;
    }


}
