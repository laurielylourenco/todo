<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{

     use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example_auth()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }



     public function test_user_registe(): void
    {

        // 1 cenario
        $userData = [
            'name' => 'Teste de Registro 1',
            'email' => 'teste1@gmail.com',
            'password' => 'password123'
        ];

        // acao

        $response = $this->postJson('/api/register', $userData);

        // verficacao
    
        $response->assertStatus(201);

        $response->assertJsonStructure(['access_token']);
        $this->assertDatabaseHas('users', [
            'email' => 'teste1@gmail.com'
        ]);    
    }


    public function test_user_login(): void
    {

        // 1 cenario
         User::factory()->create([
            'email' => 'teste1@gmail.com','password' => bcrypt('password123')
        ]);

        $userData = [
            // 'name' => 'Teste de Registro 1',
            'email' => 'teste1@gmail.com',
            'password' => 'password123'
        ];

        // acao
        
        $response = $this->postJson('/api/login', $userData);
        
        // verficacao

        // verifica status
        $response->assertStatus(200);
        // verifica retorno da api
        $response->assertJsonStructure(['access_token']);
        
    }



    public function test_user_error_login_password(): void
    {
        // 1 cenario
         User::factory()->create([
            'email' => 'teste1@gmail.com',  'password' => bcrypt('senhaCorreta')
        ]);


        $userData = [
            // 'name' => 'Teste de Registro 1',
            'email' => 'teste1@gmail.com',
            'password' => 'senhaErrada'
        ];

        // acao 
        $response = $this->postJson('/api/login', $userData);


        // verifica status
        $response->assertStatus(401);
        // verifica retorno da api

    }
}
