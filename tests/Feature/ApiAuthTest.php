<?php

namespace Tests\Feature;


use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Artisan;

class ApiAuthTest extends TestCase
{
    /**
     * Testando a criação de usuário.
     *
     * @return void
     */
    public function testMustCreateUser()
    {
        $user = [
            'name' => 'Administrador',
            'email' => 'admin@queroquitar.com.br',
            'password' => 'adminqueroquitar',
            'password_confirmation' => 'adminqueroquitar',
        ];

        $response = $this->call('POST', 'api/register', $user);

        $data = json_decode($response->content());

        $this->assertEquals(true, $data->success);
        $this->assertEquals('Parabéns! você está cadastrado no sistema.', $data->message);
    }


    /**
     * Testando o login do usuário.
     *
     * @return void
     */
    public function testUserLogin()
    {

        $user = [
            'email' => 'admin@queroquitar.com.br',
            'password' => 'adminqueroquitar',
        ];

        $response = $this->call('POST', 'api/login', $user);

        $data = json_decode($response->content());

        $this->assertEquals(true, $data->success);

        if ($data->success) {
            $this->token = $data->data->token;
        }

    }

    /**
     * Testando a autenticação.
     *
     * @return void
     */
    public function testMustBeAuthenticated()
    {
        $response = $this->call('GET', 'api/test');
        $data = json_decode($response->content());
        $this->assertEquals('token_not_provided', $data->error);
    }


}
