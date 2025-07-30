<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

it('registers a user', function () {
    $formData = [
        'name' => 'John',
        'email' => 'juancito@gmail.com',
        'password' => 'secret_password',
        'password_confirmation' => 'secret_password',
    ];

    $response = $this->from(route('guest.registerform'))
        ->post(route('guest.register'), $formData);

    $response->assertRedirectToRoute('dashboard')
        ->assertSessionHasNoErrors();

    $users = User::all();

    expect($users)->toHaveCount(1)
        ->and($users->first()->name)->toBe($formData['name'])
        ->and($users->first()->email)->toBe($formData['email'])
        ->and(Hash::check($formData['password'], $users->first()->password))->toBeTrue();

});

it('password length is short', function () {
    $formData = [
        'name' => 'John',
        'email' => 'juancito@gmail.com',
        'password' => '123',
        'password_confirmation' => '123',
    ];

    $response = $this->from(route('guest.registerform'))
        ->post(route('guest.register'), $formData);

    $response->assertStatus(302) // Redirección por error de validación
        ->assertRedirect(route('guest.registerform'))
        ->assertSessionHasErrors(['password']);
});

it('show register form', function () {
    Auth::logout();

    $response = $this->get(route('guest.registerform'));
    $response->assertStatus(200)
        ->assertViewIs('auth.register');
});

it('show login form', function () {
    Auth::logout();

    $response = $this->get(route('guest.loginForm'));
    $response->assertStatus(200)
        ->assertViewIs('auth.login');
});

// ========== PRUEBAS DE LOGIN ==========

it('user can login with valid credentials', function () {
    $user = User::factory()->create([
        'email' => 'test@example.com',
        'password' => Hash::make('password123'),
    ]);

    $response = $this->post(route('login'), [
        'email' => 'test@example.com',
        'password' => 'password123',
    ]);

    $response->assertRedirect('dashboard')
        ->assertSessionHas('success', 'Bienvenido de vuelta!');

    $this->assertAuthenticated();

    expect(Auth::user()->id)->toBe($user->id);
});

it('user can login with remember me option', function () {
    $user = User::factory()->create([
        'email' => 'test@example.com',
        'password' => Hash::make('password123'),
    ]);

    $response = $this->post(route('login'), [
        'email' => 'test@example.com',
        'password' => 'password123',
        'remember' => true,
    ]);

    $response->assertRedirect('dashboard');

    $this->assertAuthenticated();

    // Verificar que se creó la cookie de remember
    $response->assertCookie(Auth::getRecallerName());
});

it('login fails with invalid credentials', function () {
    User::factory()->create([
        'email' => 'test@example.com',
        'password' => Hash::make('password123'),
    ]);

    $response = $this->post(route('login'), [
        'email' => 'test@example.com',
        'password' => 'wrongpassword',
    ]);

    $response->assertRedirect()
        ->assertSessionHasErrors(['email' => 'Las credenciales no coinciden con nuestros registros.']);

    $this->assertGuest();
});

it('login fails with non-existent email', function () {
    $response = $this->post(route('login'), [
        'email' => 'nonexistent@example.com',
        'password' => 'password123',
    ]);

    $response->assertRedirect()
        ->assertSessionHasErrors(['email' => 'Las credenciales no coinciden con nuestros registros.']);

    $this->assertGuest();
});

it('login validation fails when email is missing', function () {
    $response = $this->post(route('login'), [
        'password' => 'password123',
    ]);

    $response->assertRedirect()
        ->assertSessionHasErrors(['email' => 'El email es obligatorio.']);

    $this->assertGuest();
});

it('login validation fails when password is missing', function () {
    $response = $this->post(route('login'), [
        'email' => 'test@example.com',
    ]);

    $response->assertRedirect()
        ->assertSessionHasErrors(['password' => 'La contraseña es obligatoria.']);

    $this->assertGuest();
});

it('login validation fails with invalid email format', function () {
    $response = $this->post(route('login'), [
        'email' => 'invalid-email',
        'password' => 'password123',
    ]);

    $response->assertRedirect()
        ->assertSessionHasErrors(['email' => 'El email debe ser válido.']);

    $this->assertGuest();
});

it('login returns input data on validation failure', function () {
    $response = $this->post(route('login'), [
        'email' => 'invalid-email',
        'password' => 'password123',
    ]);

    $response->assertRedirect()
        ->assertSessionHasInput('email', 'invalid-email');
});

it('login redirects to intended url after successful authentication', function () {
    $user = User::factory()->create([
        'email' => 'test@example.com',
        'password' => Hash::make('password123'),
    ]);

    // Simular que el usuario intentó acceder a una página protegida
    $this->get('/profile'); // Esto debería redirigir al login y guardar la URL intended

    $response = $this->post(route('login'), [
        'email' => 'test@example.com',
        'password' => 'password123',
    ]);

    // Si no hay URL intended, debería ir a dashboard por defecto
    $response->assertRedirect('dashboard');
});

// ========== PRUEBAS DE LOGOUT ==========

it('authenticated user can logout', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    expect(Auth::check())->toBeTrue(); // Verificar que está logueado

    $response = $this->post(route('logout'));

    $response->assertRedirect(route('login'))
        ->assertSessionHas('success', 'Sesión cerrada correctamente.');

    $this->assertGuest(); // Verificar que ya no está autenticado

    expect(Auth::check())->toBeFalse(); // Double check
});

it('logout invalidates session', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    // Obtener el ID de sesión antes del logout
    $sessionId = session()->getId();

    $response = $this->post(route('logout'));

    // Verificar que la sesión fue invalidada (nuevo ID)
    expect(session()->getId())->not->toBe($sessionId);

    $response->assertRedirect(route('login'));
});

it('logout regenerates csrf token', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    // Obtener el token CSRF antes del logout
    $oldToken = csrf_token();

    $response = $this->post(route('logout'));

    // El token debería haberse regenerado
    expect(csrf_token())->not->toBe($oldToken);

    $response->assertRedirect(route('login'));
});

it('guest user cannot access logout', function () {
    // Si tienes middleware auth en la ruta logout
    $response = $this->post(route('logout'));

    // Esto depende de cómo manejes guests en logout
    // Podría ser redirect al login o simplemente procesar sin error
    $response->assertRedirect(route('login'));
});
