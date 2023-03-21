<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

class UserTest extends TestCase
{
    /**
     * Test se usuario pode se cadastrar.
     *
     * @return void
     */
    public function testUsuarioPodeSeCadastrar()
    {
        $payload = [
            'name' => 'Luiz',
            'email' => fake()->unique()->safeEmail(),
            'password' => 'supersecreto7',
            'password_confirmation' => 'supersecreto7',
        ];

        $response = $this->post(route('register.user'), $payload);

        $response->assertRedirect();
        $this->assertDatabaseHas('users', [
            'email' => $payload['email'],
            'name' => $payload['name'],
        ]);
    }

    public function test_pode_logar_com_credenciais_validas()
    {
        $user = User::factory()->create();

        $response = $this->post('/api/authenticate', [
            'email' => $user->email,
            'password' => $user->password,
        ]);
        $this->actingAs($user);
        $this->assertAuthenticatedAs($user);
        $response->assertStatus(302);
    }

    public function testUsuarioNaoPodeAutenticarComCredenciaisErradas()
    {
        $user = User::factory()->create();
        $payload = [
            'email' => $user->email,
            'password' => 'senhateste7'
        ];

        $response = $this->post(route('auth.user'), $payload);

        $response->assertStatus(302);
        $response->assertSeeText('Redirecting to http://localhost:8000');
    }
}
