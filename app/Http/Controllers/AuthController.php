<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Auth\RegisterUser;
use App\DTOs\RegisterUserData;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

final class AuthController
{
    public function showRegisterForm(): View
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request, RegisterUser $registerUserAction): RedirectResponse
    {
        $user = $registerUserAction->handle(
            RegisterUserData::fromArray($request->validated())
        );

        return redirect()->route('dashboard')->with('success', 'Registro exitoso. ¡Bienvenido!');
    }

    public function showLoginForm(): View
    {
        return view('auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'El email es obligatorio.',
            'email.email' => 'El email debe ser válido.',
            'password.required' => 'La contraseña es obligatoria.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard')->with('success', 'Bienvenido de vuelta!');
        }

        return redirect()->back()
            ->withErrors(['email' => 'Las credenciales no coinciden con nuestros registros.'])
            ->withInput();
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Sesión cerrada correctamente.');
    }
}
