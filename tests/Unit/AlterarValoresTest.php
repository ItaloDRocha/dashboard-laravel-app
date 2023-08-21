<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\UserData;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AlterarValoresTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */


    public function test_criar_dados_user()
    {

        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    public function test_alterar_dados_user()
    {


        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $values = [
            'profit' => "23523",
            'growth' => "1721",
            'orders' => "3685",
            'customers' => "289"
        ];

        $response = $this->actingAs($user)->put('/admindashboard/alterarValores', $values);
        $response->assertSessionHas("message", 'Dados alterados com sucesso!');
    }
}
