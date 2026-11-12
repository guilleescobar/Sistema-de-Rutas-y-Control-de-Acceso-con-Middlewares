<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AccessControlTest extends TestCase
{
    use RefreshDatabase;

    private User $adminUser;
    private User $adultUser;
    private User $underageUser;

    protected function setUp(): void
    {
        parent::setUp();

        // 1. Administrador mayor de edad
        $this->adminUser = User::factory()->create([
            'name' => 'Carlos Mendoza',
            'email' => 'admin@resort.com',
            'is_admin' => true,
            'age' => 45,
        ]);

        // 2. Usuario normal mayor de edad
        $this->adultUser = User::factory()->create([
            'name' => 'Valeria Castillo',
            'email' => 'adulto@resort.com',
            'is_admin' => false,
            'age' => 26,
        ]);

        // 3. Usuario normal menor de edad
        $this->underageUser = User::factory()->create([
            'name' => 'Mateo Fernández',
            'email' => 'menor@resort.com',
            'is_admin' => false,
            'age' => 16,
        ]);
    }

    public function test_public_routes_are_accessible_without_authentication(): void
    {
        $responseHome = $this->get('/');
        $responseHome->assertStatus(200);

        $responseLogin = $this->get('/login');
        $responseLogin->assertStatus(200);

        $responseRegister = $this->get('/register');
        $responseRegister->assertStatus(200);
    }

    public function test_unauthenticated_user_is_redirected_to_login_when_accessing_private_routes(): void
    {
        // Panel
        $responsePanel = $this->get('/panel');
        $responsePanel->assertRedirect(route('login'));
        $responsePanel->assertSessionHas('error');

        // Casino
        $responseCasino = $this->get('/casino');
        $responseCasino->assertRedirect(route('login'));

        // Admin
        $responseAdmin = $this->get('/admin');
        $responseAdmin->assertRedirect(route('login'));
    }

    public function test_authenticated_user_can_access_panel(): void
    {
        $response = $this->actingAs($this->adultUser)->get('/panel');

        $response->assertStatus(200);
        $response->assertSee('Valeria Castillo');
    }

    public function test_underage_user_is_denied_access_to_casino_and_redirected_to_panel_with_exact_message(): void
    {
        $response = $this->actingAs($this->underageUser)->get('/casino');

        $response->assertRedirect('/panel');
        $response->assertSessionHas('error', 'Acceso denegado: Debes ser mayor de edad.');
    }

    public function test_adult_user_can_access_casino(): void
    {
        $response = $this->actingAs($this->adultUser)->get('/casino');

        $response->assertStatus(200);
        $response->assertSee('Casino VIP');
    }

    public function test_regular_user_is_denied_access_to_admin_office(): void
    {
        $response = $this->actingAs($this->adultUser)->get('/admin');

        $response->assertRedirect(route('home'));
        $response->assertSessionHas('error');
    }

    public function test_admin_user_can_access_all_areas(): void
    {
        // Habitación
        $responsePanel = $this->actingAs($this->adminUser)->get('/panel');
        $responsePanel->assertStatus(200);

        // Casino
        $responseCasino = $this->actingAs($this->adminUser)->get('/casino');
        $responseCasino->assertStatus(200);

        // Oficina de dirección
        $responseAdmin = $this->actingAs($this->adminUser)->get('/admin');
        $responseAdmin->assertStatus(200);
        $responseAdmin->assertSee('Oficina de Dirección');
    }
}

