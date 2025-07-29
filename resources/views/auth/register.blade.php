@extends('layouts.app')

@section('title', 'Registro')

@section('content')
    <div class="auth-container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <div class="auth-card">
                        <div class="card-header bg-primary text-white text-center py-4">
                            <h3 class="mb-0">
                                <i class="bi bi-person-plus"></i> Crear Cuenta
                            </h3>
                            <p class="mb-0 mt-2 opacity-75">Únete a nuestra comunidad</p>
                        </div>

                        <div class="card-body p-4">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <!-- Nombre -->
                                <div class="mb-3">
                                    <label for="name" class="form-label">
                                        <i class="bi bi-person"></i> Nombre completo
                                    </label>
                                    <input type="text"
                                           class="form-control @error('name') is-invalid @enderror"
                                           id="name"
                                           name="name"
                                           value="{{ old('name') }}"
                                           required
                                           autocomplete="name"
                                           placeholder="Tu nombre completo">
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

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
                                           placeholder="tu@email.com">
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
                                           autocomplete="new-password"
                                           placeholder="Mínimo 8 caracteres">
                                    @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Confirmar contraseña -->
                                <div class="mb-4">
                                    <label for="password_confirmation" class="form-label">
                                        <i class="bi bi-lock-fill"></i> Confirmar contraseña
                                    </label>
                                    <input type="password"
                                           class="form-control"
                                           id="password_confirmation"
                                           name="password_confirmation"
                                           required
                                           autocomplete="new-password"
                                           placeholder="Repite tu contraseña">
                                </div>

                                <!-- Botón de registro -->
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="bi bi-person-plus"></i> Crear mi cuenta
                                    </button>
                                </div>
                            </form>
                        </div>

                        <div class="card-footer text-center py-3 bg-light">
                            <p class="mb-0">
                                ¿Ya tienes cuenta?
                                <a href="{{ route('login') }}" class="text-decoration-none">
                                    <i class="bi bi-box-arrow-in-right"></i> Iniciar sesión
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
