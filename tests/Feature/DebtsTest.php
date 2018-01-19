<?php

namespace Tests\Feature;

use App\Debt;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DebtsTest extends TestCase
{
   
    /**
     * Testando o login do usuário.
     *
     * @return void
     */
    protected function login()
    {
        $user = [
            'email' => 'admin@queroquitar.com.br',
            'password' => 'adminqueroquitar',
        ];
      
        $response = $this->call('POST', 'api/login', $user);

        $data = json_decode($response->content());

        if ($data->success) {
            $token = $data->data->token;
        }

        return $token;
       
    }


    /**
     * Testando a inserção do debito.
     *
     * @return void
     */
    public function testMustInsertDebt() 
    {

        $token = $this->login();

        $debt = [
            'name' => 'Conta',
            'date' => '19/01/2018',
            'value' => 'R$ 1000,00',
            'phone' => '1195723-1563'
        ];
      
        $url =  'api/debt/save?token='.$token;
        $response = $this->call('POST', $url, $debt);

        $data = json_decode($response->content());

        $this->assertEquals(true, $data->success);
        $this->assertEquals('Parabéns! cadastrado no sistema.', $data->message);

    }



    /**
     * Mostrando todos os debitos.
     *
     * @return void
     */
    public function testMustShowAllDebts() 
    {

        $token = $this->login();
      
        $url =  'api/debts/all?token='.$token;
        $response = $this->call('GET', $url);
        $data = json_decode($response->content());

        $this->assertEquals(true, $data->success);

    }


    /**
     * Atualizando o primeiro debito.
     *
     * @return void
     */
    public function testMustUpdateDebt() 
    {

        $token = $this->login();

        $id = Debt::first()->id;

   
        $debt = [
            'name' => 'Conta 2',
            'date' => '19/01/2018',
            'value' => 'R$ 1000,00',
            'phone' => '1195723-1563'
        ];

        $url =  'api/debt/update/'.$id.'/?token='.$token;
        $response = $this->call('POST', $url, $debt);
        $data = json_decode($response->content());

        $this->assertEquals(true, $data->success);
        $this->assertEquals('Parabéns! atualizado no sistema.', $data->message);

    }

}
