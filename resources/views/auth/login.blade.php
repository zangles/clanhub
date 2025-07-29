@extends('layouts.app')

@section('title', 'Iniciar Sesión')

@section('content')
    <div class="auth-container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <div class="auth-card">
                        <div class="card-header bg-primary text-white text-center py-4">
                            <h3 class="mb-0">
                                <i class="bi bi-box-arrow-in-right"></i> Iniciar Sesión
                            </h3>
                            <p class="mb-0 mt-2 opacity-75">Bienvenido de vuelta</p>
                        </div>

                        <div class="card-body p-4">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <!-- Email -->
                                <div class="mb-3">
                                    <label for="email" class="form-label">
                                        <i class="bi bi-envelope"></i> Correo electrónico
                                    </label>
                                    <input type="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           id="email"
                                           name="email"
                                           value="{{ old('email') }}"
                                           required
                                           autocomplete="email"
                                           placeholder="tu@email.com"
                                           autofocus>
                                    @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Contraseña -->
                                <div class="mb-3">
                                    <label for="password" class="form-label">
                                        <i class="bi bi-lock"></i> Contraseña
                                    </label>
                                    <input type="password"
                                           class="form-control @error('password') is-invalid @enderror"
                                           id="password"
                                           name="password"
                                           required
                                           autocomplete="current-password"
                                           placeholder="Tu contraseña">
                                    @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Recordar sesión -->
                                <div class="mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input"
                                               type="checkbox"
                                               id="remember"
                                               name="remember">
                                        <label class="form-check-label" for="remember">
                                            <i class="bi bi-heart"></i> Recordar mi sesión
                                        </label>
                                    </div>
                                </div>

                                <!-- Botón de login -->
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="bi bi-box-arrow-in-right"></i> Iniciar Sesión
                                    </button>
                                </div>
                            </form>
                        </div>

                        <div class="card-footer text-center py-3 bg-light">
                            <p class="mb-0">
                                ¿No tienes cuenta?
                                <a href="{{ route('register') }}" class="text-decoration-none">
                                    <i class="bi bi-person-plus"></i> Registrarse
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
