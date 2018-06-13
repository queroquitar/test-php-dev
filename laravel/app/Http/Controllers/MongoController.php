<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MongoController extends Controller
{

    private $mongo;

    public function __construct()
    {
        $this->mongo = (new \MongoDB\Client)->test->data;
    }

    public function get($id = null)
    {
        if($id){
            $data = $this->mongo->findOne(['_id' => new \MongoDB\BSON\ObjectId($id)]);
            if($data)
                return ['data' => $data ,"code"=>0];
            return ['data' => null ,"code"=>"id não encontrado"];
        }
        return ['data' => $this->mongo->find()->toArray() ,"code"=>0];        
    }

    public function post(Request $request)
    {
        $id = $request->input('_id');
        $data = $request->all();
        unset($data['_id']);
        unset($data['token']);

        if($id){
            $result = $this->mongo->updateOne(
                ['_id'=> new \MongoDB\BSON\ObjectId($id) ],
                ['$set' => $data]
            );
            return ['data' => $data ,"code"=>0];
        }
        
        $item = $this->mongo->insertOne($data);
        $data['_id'] = $item->getInsertedId();
        return ['data' => $data ,"code"=>0];
    }

    public function delete($id)
    {
        $this->mongo->deleteOne(['_id' => new \MongoDB\BSON\ObjectId($id)]);
        return ['data' => null,"code"=>0];
    }
}
