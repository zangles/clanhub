<?php

declare(strict_types=1);

use App\DTOs\RegisterUserData;

it('registers a user', function () {
    $dto = new RegisterUserData(
        name: 'John',
        email: 'aaaa@gmail.com',
        password: 'secret',
    );

    $user = (new App\Actions\Auth\RegisterUser())->handle($dto);

    expect($user)->toBeInstanceOf(App\Models\User::class);
});
