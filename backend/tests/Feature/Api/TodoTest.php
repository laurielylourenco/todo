<?php

namespace Tests\Feature\Api;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodoTest extends TestCase
{

    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }


    public function test_a_user_can_only_get_their_own_todos(): void
    {
        // 1. Cenário (Arrange)
        // Criamos dois usuários e uma tarefa para cada um
        $userA = User::factory()->create();
        $userA = User::find($userA->id);
        $todoFromUserA = Todo::factory()->create(['user_id' => $userA->id]);

        $userB = User::factory()->create();
        $userB = User::find($userB->id);
        $todoFromUserB = Todo::factory()->create(['user_id' => $userB->id]);

        // 2. Ação (Act)
        // Nós nos autenticamos como o Usuário A e buscamos a lista de tarefas
        $response = $this->actingAs($userA)->getJson('/api/todos');

        // 3. Verificação (Assert)
        // Verificamos se a resposta foi bem-sucedida
        $response->assertStatus(200);

        // Verificamos se a resposta contém EXATAMENTE 1 tarefa
        $response->assertJsonCount(1);

        // Verificamos se a tarefa do Usuário A está na resposta
        $response->assertJsonFragment(['title' => $todoFromUserA->title]);

        // E o mais importante: verificamos se a tarefa do Usuário B NÃO está na resposta
        $response->assertJsonMissing(['title' => $todoFromUserB->title]);
    }


    /**
     * Testa se um usuário autenticado pode criar uma nova tarefa.
     *
     * @return void
     */
    public function test_an_authenticated_user_can_create_a_todo(): void
    {
        // 1. Cenário (Arrange)
        // Apenas precisamos de um usuário autenticado
        $user = User::factory()->create();
        $user = User::find($user->id);

        $taskData = [
            'title' => 'Minha primeira tarefa via API'
        ];

        // 2. Ação (Act)
        // Nos autenticamos como o usuário e enviamos os dados da nova tarefa para o endpoint de criação
        $response = $this->actingAs($user)->postJson('/api/todos', $taskData);

        // 3. Verificação (Assert)
        // Verificamos se a tarefa foi criada com sucesso (status 201)
        $response->assertStatus(201);

        // Verificamos se a resposta contém o título que enviamos
        $response->assertJsonFragment($taskData);

        // Verificamos se a tarefa realmente foi salva no banco de dados e associada ao usuário correto
        $this->assertDatabaseHas('todos', [
            'title' => 'Minha primeira tarefa via API',
            'user_id' => $user->id,
            'completed' => false // O valor padrão
        ]);
    }

    public function test_user_can_update_a_todo(): void
    {
        // 1. Cenário (Arrange)
        // Apenas precisamos de um usuário autenticado
        $user = User::factory()->create();
        $user = User::find($user->id);

        $task  = Todo::factory()->create(['user_id' => $user->id]);

        $taskData = [
            'title' => 'vamos tooooddddddddddooooooooooo atualizar a tarefa',
            'completed' => true
        ];

        // crie uma tarefa para o usuário
        // 2. Ação (Act)
        // Nos autenticamos como o usuário e enviamos os dados da nova tarefa para o endpoint de criação
        $response = $this->actingAs($user)->putJson("/api/todos/{$task->id}", $taskData);


        // 3. Verificação (Assert)
        // Verificamos se a tarefa foi criada com sucesso (status 200)
        $response->assertStatus(200);

        $this->assertDatabaseHas('todos', [
            'title' => 'vamos tooooddddddddddooooooooooo atualizar a tarefa',
            'user_id' => $user->id,
            'completed' => true // O valor atualizado
        ]);
    }


    public function test_user_can_delete_a_todo(): void
    {
        //1.Cenario (Arrange)

        $user = User::factory()->create();
        $user = User::find($user->id);

        //crie uma tarefas para o usuário 
        $task  = Todo::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->deleteJson("/api/todos/{$task->id}");

        //2.Acao 

        $response->assertStatus(204);

        // 3 . Verificacao 
        $this->assertDatabaseMissing('todos', [
            'id' => $task->id,
            'user_id' => $user->id,
        ]);
    }
}
