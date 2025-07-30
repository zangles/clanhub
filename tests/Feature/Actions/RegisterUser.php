<?php

declare(strict_types=1);

use App\DTOs\RegisterUserData;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

it('registers a user', function () {
    $registerUserAction = new App\Actions\Auth\RegisterUser();

    $formData = [
        'name' => 'John',
        'email' => 'juancito@gmail.com',
        'password' => 'secret_password',
        'password_confirmation' => 'secret_password',
    ];

    $user = $registerUserAction->handle(
        RegisterUserData::fromArray($formData)
    );

    expect($user)->toBeInstanceOf(User::class)
        ->and(Auth::check())->toBeTrue()
        ->and(Auth::user())->toBe($user);

});
