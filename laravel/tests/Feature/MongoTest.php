<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MongoTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCRUDmongo()
    {
        $response = $this->json('POST', '/api/auth/login', 
            [
                'email' => 'exemplo@exemplo.com',
                'password' => "123456"
            ]);
        $resp = json_decode($response->getContent());
        $token = $resp->access_token;
        $response->assertStatus(200)
                ->assertJson([
                        'access_token' => $token
                ]);
        
        //All mongo data
        $response = $this->json('GET', '/api/mongo?token='.$token);

        $resp = json_decode($response->getContent());

        $response->assertStatus(200)
                ->assertJson([
                        'data' => [
                            ['date' => '20/01/2018']
                        ]
                ]);

        //id mongo data
        $oid = '$oid';
        $id = $resp->data[0]->_id->$oid;
        $response = $this->json('GET', '/api/mongo/'.$id.'?token='.$token);

        $resp = json_decode($response->getContent());

        $response->assertStatus(200)
                ->assertJson([
                        'data' => ['date' => '20/01/2018']
                ]);
        

        //Create mongo data
        $mongoData = [
            'date' => '00/00/0000',
            'name' => 'Test 999',
            'price' => '9.00',
            'value' => '000'
        ];
        $response = $this->json('POST', '/api/mongo/?token='.$token, $mongoData);

        $resp = json_decode($response->getContent());
        $response->assertStatus(200)
                ->assertJson([
                        'data' => $mongoData
                ]);

        //Update mongo data
        $mongoData = [
            'date' => '00/00/0000',
            'name' => 'Test 888',
            'price' => '9.00',
            'value' => '000'
        ];
        $mongoData['_id'] = $resp->data->_id->$oid;

        $response = $this->json('POST', '/api/mongo/?token='.$token, $mongoData);
        unset($mongoData['_id']);
        $response->assertStatus(200)
                ->assertJson([
                        'data' => $mongoData
                ]);
        
        //Delete mongo data
        $id = $resp->data->_id->$oid;
        $response = $this->json('DELETE', '/api/mongo/'.$id.'?token='.$token, $mongoData);
        $response->assertStatus(200)
                ->assertJson([
                        'code' => 0
                ]);
    }
}
