<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_page_loads(): void
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
    }

    public function test_login_page_loads(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    public function test_user_can_register(): void
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
            'role' => 'business_owner',
            'email_verified_at' => now(),
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
            'name' => 'Test User',
            'role' => 'business_owner',
        ]);
    }

    public function test_user_can_login(): void
    {
        $user = User::factory()->create([
            'email' => 'login@example.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ]);

        $response = $this->post('/login', [
            'email' => 'login@example.com',
            'password' => 'password',
        ]);

        $response->assertStatus(302);
        $this->assertAuthenticated();
    }

    public function test_user_with_invalid_credentials_cannot_login(): void
    {
        User::factory()->create([
            'email' => 'login@example.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->post('/login', [
            'email' => 'login@example.com',
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }

    public function test_forgot_password_page_loads(): void
    {
        $response = $this->get('/forgot-password');
        $response->assertStatus(200);
    }

    public function test_dashboard_requires_authentication(): void
    {
        $response = $this->get('/dashboard');
        $response->assertStatus(302);
    }

    public function test_authenticated_user_can_access_dashboard(): void
    {
        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $response = $this->actingAs($user)->get('/dashboard');
        $response->assertStatus(200);
    }

    public function test_logout_works(): void
    {
        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $this->actingAs($user);
        $response = $this->post('/logout');
        $response->assertStatus(302);
        $this->assertGuest();
    }

    public function test_admin_can_access_admin_routes(): void
    {
        $admin = User::factory()->create([
            'email_verified_at' => now(),
            'role' => 'admin',
        ]);

        $this->actingAs($admin);
        $this->get('/admin/categories')->assertStatus(200);
        $this->get('/admin/currencies')->assertStatus(200);
        $this->get('/admin/moderation')->assertStatus(200);
        $this->get('/admin/ad-campaigns')->assertStatus(200);
    }

    public function test_non_admin_cannot_access_admin_routes(): void
    {
        $user = User::factory()->create([
            'email_verified_at' => now(),
            'role' => 'business_owner',
        ]);

        $this->actingAs($user);
        $this->get('/admin/categories')->assertStatus(403);
        $this->get('/admin/moderation')->assertStatus(403);
    }

    public function test_unverified_user_cannot_access_dashboard(): void
    {
        $user = User::factory()->unverified()->create();

        $response = $this->actingAs($user)->get('/dashboard');
        $response->assertStatus(302);
    }
}
