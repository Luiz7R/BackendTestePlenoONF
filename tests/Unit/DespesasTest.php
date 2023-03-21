<?php

namespace Tests\Unit;

use App\Models\Despesa;
use App\Models\User;
use DateInterval;
use DateTime;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DespesasTest extends TestCase
{
  use DatabaseTransactions;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_VisitanteNaoPodeVerDespesasSemAutenticacao()
    {
        $response = $this->withHeaders([
          'accept' => 'application/json'
        ])->get(route('despesas.index'));

        $response->assertStatus(401)
                 ->assertSeeText('Unauthenticated');
    }

    public function test_UsuarioPodeVerPropriasDespesas()
    {
        $user = User::factory()->has(Despesa::factory()->count(10))
        ->create();
        $this->actingAs($user);

        $response = $this->withHeaders([
          'accept' => 'application/json'
        ])->get(route('despesas.index'));

        $content = json_decode($response->getContent(), true);
        $response->assertOk();
        $this->assertEquals($content[0]["id_usuario"],$user['id']);
    }

    public function test_UsuarioNaoPodeVerDespesaDeOutroUsuario()
    {
        $user = User::factory()->has(Despesa::factory()->count(1))
        ->create();
        $idDespesa = $user->despesas->first()->id;

        $user2 = User::factory()->create();
        $this->actingAs($user2);

        $response = $this->withHeaders([
          'accept' => 'application/json'
        ])->get(route('despesas.show',['despesa' => $idDespesa]));

        $response->assertStatus(403)
                 ->assertSeeText('Acesso Negado');
    }

    public function test_UsuarioNaoPodeAtualizarDespesaDeOutroUsuario()
    {
        $user = User::factory()->has(Despesa::factory()->count(1))
        ->create();
        $despesa = $user->despesas->first();
        $despesa->valor = 5000;
        $despesa->descricao = "Despesa Test Usuario Nao pode atualizar";

        $user2 = User::factory()->create();
        $this->actingAs($user2);

        $response = $this->withHeaders([
          'accept' => 'application/json'
        ])->get(route('despesas.update',['despesa' => $despesa->id]), [
            $despesa
        ]);

        $response->assertStatus(403)
                 ->assertSeeText('Acesso Negado');
    }

    public function test_UsuarioPodeAtualizarPropriaDespesa()
    {
        $user = User::factory()->has(Despesa::factory()->count(1))
        ->create();
        $despesa = $user->despesas->first();
        $despesa->valor = 5000;
        $despesa->descricao = "Despesa Test Usuario Atualizar propria Despesa";
        $this->actingAs($user);

        $response = $this->withHeaders([
          'accept' => 'application/json'
        ])->put(route('despesas.update',['despesa' => $despesa->id]), [
            'valor' => 5000,
            'descricao' => "Despesa Test Usuario Atualizar propria Despesa"
        ]);

        $response->assertOk();

        $this->assertDatabaseHas('despesas', [
                'id' => $despesa->id,
                'valor' => 5000,
                'descricao' => "Despesa Test Usuario Atualizar propria Despesa",
        ]);
    }

    public function test_UsuarioNaoPodeDeletarDespesaDeOutroUsuario()
    {
        $user = User::factory()->has(Despesa::factory()->count(1))
        ->create();
        $despesa = $user->despesas->first();

        $user2 = User::factory()->create();
        $this->actingAs($user2);

        $response = $this->withHeaders([
          'accept' => 'application/json'
        ])->get(route('despesas.destroy',['despesa' => $despesa->id]));

        $response->assertStatus(403)
                 ->assertSeeText('Acesso Negado');
    }

    public function test_UsuarioPodeDeletarPropriaDespesa()
    {
        $user = User::factory()->has(Despesa::factory()->count(1))
        ->create();
        $despesa = $user->despesas->first();

        $this->actingAs($user);

        $response = $this->withHeaders([
          'accept' => 'application/json'
        ])->delete(route('despesas.destroy',['despesa' => $despesa->id]));

        $response->assertOk();

        $this->assertDatabaseMissing('despesas', [
          'id' => $despesa->id
        ]);
    }

    public function test_ErroDespesaNaoEncontrada()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->withHeaders([
          'accept' => 'application/json'
        ])->get(route('despesas.show',['despesa' => 1000]));
        
        $response->assertStatus(404);
        $this->assertDatabaseMissing('despesas', [
          'id' => 10000
        ]);
    }

    public function test_NaoPodeCriarDespesaDataFutura()
    {
      $user = User::factory()->create();
      $this->actingAs($user);

      $hoje = new DateTime();
      $amanha = $hoje->add(new DateInterval('P1D'));
      $dataFormatada = $amanha->format('Y-m-d');

      $response = $this->withHeaders([
        'accept' => 'application/json'
      ])->post(route('despesas.store'),[
        'descricao' => 'Testando Descricao',
        'data_despesa' => $dataFormatada,
        'valor' => 1000
      ]);
      $response->assertStatus(422);
    }

    public function test_NaoPodeCriarDespesaDescricaoMaiorQue_191Caracteres()
    {
      $user = User::factory()->create();
      $this->actingAs($user);
      $descricao = 'a descricao das despesas nao pode ser maior que 191 caracteres, a descricao';
      $descricao .= 'das despesas nao pode ser maior que 191 caracteres,a descricao das despesas';
      $descricao .= 'nao pode ser maior que 191 caracteres ok, nao pode ser maior que 191 caracteres';
      $data = new DateTime();
      $dataFormatada = $data->format('Y-m-d');

      $response = $this->withHeaders([
        'accept' => 'application/json'
      ])->post(route('despesas.store'),[
        'descricao' => $descricao,
        'data_despesa' => $dataFormatada,
        'valor' => 1000
      ]);

      $response->assertStatus(422)->assertSeeText('maior que 191 caracteres');
    }

    public function test_NaoPodeCriarDespesaComValorNegativo()
    {
      $user = User::factory()->create();
      $this->actingAs($user);
      $data = new DateTime();
      $dataFormatada = $data->format('Y-m-d');

      $response = $this->withHeaders([
        'accept' => 'application/json'
      ])->post(route('despesas.store'),[
        'descricao' => 'Descricao Teste',
        'data_despesa' => $dataFormatada,
        'valor' => 0
      ]);

      $response->assertStatus(422)->assertSeeText('Valor da Despesa deve ser positivo');
    }

    public function test_AtualizarDespesaPrecisaPeloMenosUmCampo()
    {
      $user = User::factory()->has(Despesa::factory()->count(1))
      ->create();
      $despesa = $user->despesas->first();
      $this->actingAs($user);

      $response = $this->withHeaders([
        'accept' => 'application/json'
      ])->put(route('despesas.update',['despesa' => $despesa->id]));

      $response->assertStatus(422)
               ->assertSeeText("Pelos menos um dos campos tem que ser enviado");
    }
}
