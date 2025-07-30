<?php

declare(strict_types=1);

use App\Providers\AppServiceProvider;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\URL;

it('forces https scheme when not in local environment', function () {
    // Crear una instancia mock de la aplicación
    $app = Mockery::mock(Application::class);

    // Simular que NO está en entorno local
    $app->shouldReceive('isLocal')->andReturn(false);

    // Crear instancia del service provider con el mock
    $provider = new AppServiceProvider($app);

    // Espiar el método forceScheme de URL
    URL::shouldReceive('forceScheme')
        ->once()
        ->with('https');

    // Usar reflexión para acceder al método privado
    $reflection = new ReflectionClass($provider);
    $method = $reflection->getMethod('configureUrl');
    $method->setAccessible(true);

    // Ejecutar el método
    $method->invoke($provider);
});

it('does not force https scheme when in local environment', function () {
    // Crear una instancia mock de la aplicación
    $app = Mockery::mock(Application::class);

    // Simular que SÍ está en entorno local
    $app->shouldReceive('isLocal')->andReturn(true);

    // Crear instancia del service provider con el mock
    $provider = new AppServiceProvider($app);

    // Verificar que forceScheme NO se llama
    URL::shouldReceive('forceScheme')->never();

    // Usar reflexión para acceder al método privado
    $reflection = new ReflectionClass($provider);
    $method = $reflection->getMethod('configureUrl');
    $method->setAccessible(true);

    // Ejecutar el método
    $method->invoke($provider);
});
