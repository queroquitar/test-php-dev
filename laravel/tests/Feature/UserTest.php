<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCRUDuser()
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
        
        //All user data
        $response = $this->json('GET', '/api/user?token='.$token);

        $resp = json_decode($response->getContent());

        $response->assertStatus(200)
                ->assertJson([
                        'data' => [
                            ['email' => 'exemplo@exemplo.com']
                        ]
                ]);

        //id user data
        $id = $resp->data[0]->id;
        $response = $this->json('GET', '/api/user/'.$id.'?token='.$token);

        $resp = json_decode($response->getContent());

        $response->assertStatus(200)
                ->assertJson([
                        'data' => ['email' => 'exemplo@exemplo.com','id'=>$id]
                ]);
        

        //Create mongo data
        $user = [
            'email' => 'exemplo@exemplo.com.br',
            'password' => '123456'
        ];
        $response = $this->json('POST', '/api/user/?token='.$token, $user);

        $resp = json_decode($response->getContent());
        $response->assertStatus(200)
                ->assertJson([
                        'data' => ['email' => 'exemplo@exemplo.com.br']
                ]);

        //Update mongo data
        $user = [
            'email' => 'exemplo2@exemplo.com.br',
            'id' => $resp->data->id,
            "password" => '123456'
        ];
        $response = $this->json('POST', '/api/user/?token='.$token, $user);

        $resp = json_decode($response->getContent());
        $response->assertStatus(200)
                ->assertJson([
                        'data' => ['email' => 'exemplo2@exemplo.com.br']
                ]);
        
        //Delete mongo data
        $id = $resp->data->id;
        $response = $this->json('DELETE', '/api/user/'.$id.'?token='.$token);
        $response->assertStatus(200)
                ->assertJson([
                        'code' => 0
                ]);
    }
}
