<?php

declare(strict_types=1);

namespace App\Actions\Auth;

use App\DTOs\RegisterUserData;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

final class RegisterUser
{
    /**
     * Ejecuta la accion
     */
    public function handle(RegisterUserData $userData): User
    {
        $user = DB::transaction(function () use ($userData) {
            return User::create([
                'name' => $userData->name,
                'email' => $userData->email,
                'password' => Hash::make($userData->password),
            ]);
        });

        Auth::login($user);

        return $user;
    }
}
