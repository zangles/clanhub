<?php

declare(strict_types=1);

use App\DTOs\RegisterUserData;

describe('RegisterUserData', function () {

    it('can be instantiated with valid data', function () {
        $dto = new RegisterUserData(
            name: 'John Doe',
            email: 'john@example.com',
            password: 'secret123'
        );

        expect($dto->name)->toBe('John Doe')
            ->and($dto->email)->toBe('john@example.com')
            ->and($dto->password)->toBe('secret123');
    });

    it('can be created from array with valid data', function () {
        $data = [
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'password' => 'password456',
        ];

        $dto = RegisterUserData::fromArray($data);

        expect($dto->name)->toBe('Jane Smith')
            ->and($dto->email)->toBe('jane@example.com')
            ->and($dto->password)->toBe('password456');
    });

    it('properties are readonly', function () {
        $dto = new RegisterUserData(
            name: 'Test User',
            email: 'test@example.com',
            password: 'testpass'
        );

        // Intentar modificar una propiedad readonly debería lanzar un error
        expect(function () use ($dto) {
            $dto->name = 'Modified Name';
        })->toThrow(Error::class);
    });

    describe('fromArray method validations', function () {

        it('throws assertion error when name is not string', function () {
            $data = [
                'name' => 123, // número en lugar de string
                'email' => 'test@example.com',
                'password' => 'password',
            ];

            expect(fn () => RegisterUserData::fromArray($data))
                ->toThrow(AssertionError::class);
        });

        it('throws assertion error when email is not string', function () {
            $data = [
                'name' => 'Test User',
                'email' => null, // null en lugar de string
                'password' => 'password',
            ];

            expect(fn () => RegisterUserData::fromArray($data))
                ->toThrow(AssertionError::class);
        });

        it('throws assertion error when password is not string', function () {
            $data = [
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => ['array'], // array en lugar de string
            ];

            expect(fn () => RegisterUserData::fromArray($data))
                ->toThrow(AssertionError::class);
        });

        it('throws error when required fields are missing', function () {
            $data = [
                'name' => 'Test User',
                'email' => 'test@example.com',
                // falta password
            ];

            expect(fn () => RegisterUserData::fromArray($data))
                ->toThrow(ErrorException::class, 'Undefined array key "password"');
        });
    });

    describe('edge cases', function () {

        it('handles empty strings', function () {
            $dto = RegisterUserData::fromArray([
                'name' => '',
                'email' => '',
                'password' => '',
            ]);

            expect($dto->name)->toBe('')
                ->and($dto->email)->toBe('')
                ->and($dto->password)->toBe('');
        });

        it('handles strings with special characters', function () {
            $dto = RegisterUserData::fromArray([
                'name' => 'José María Azúcar-López',
                'email' => 'josé+test@example.com',
                'password' => 'p@ssw0rd!#$%',
            ]);

            expect($dto->name)->toBe('José María Azúcar-López')
                ->and($dto->email)->toBe('josé+test@example.com')
                ->and($dto->password)->toBe('p@ssw0rd!#$%');
        });

        it('handles very long strings', function () {
            $longString = str_repeat('a', 1000);

            $dto = RegisterUserData::fromArray([
                'name' => $longString,
                'email' => $longString.'@example.com',
                'password' => $longString,
            ]);

            expect($dto->name)->toBe($longString)
                ->and($dto->email)->toBe($longString.'@example.com')
                ->and($dto->password)->toBe($longString);
        });
    });

    describe('data integrity', function () {

        it('maintains data immutability after creation', function () {
            $originalData = [
                'name' => 'Original Name',
                'email' => 'original@example.com',
                'password' => 'original123',
            ];

            $dto = RegisterUserData::fromArray($originalData);

            // Modificar el array original no debe afectar el DTO
            $originalData['name'] = 'Modified Name';

            expect($dto->name)->toBe('Original Name');
        });

        it('can be serialized and compared', function () {
            $dto1 = new RegisterUserData('John', 'john@example.com', 'pass123');
            $dto2 = new RegisterUserData('John', 'john@example.com', 'pass123');

            // Los DTOs con los mismos datos deberían ser equivalentes en contenido
            expect($dto1->name)->toBe($dto2->name)
                ->and($dto1->email)->toBe($dto2->email)
                ->and($dto1->password)->toBe($dto2->password);
        });
    });
});
