<?php

declare(strict_types=1);

namespace App\DTOs;

final class RegisterUserData
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $password,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        assert(is_string($data['name']));
        assert(is_string($data['email']));
        assert(is_string($data['password']));

        return new self(
            name: $data['name'],
            email: $data['email'],
            password: $data['password']
        );
    }
}
