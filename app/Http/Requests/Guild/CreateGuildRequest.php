<?php

declare(strict_types=1);

namespace App\Http\Requests\Guild;

use Illuminate\Foundation\Http\FormRequest;

final class CreateGuildRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'min:3',
                'max:50',
                'unique:guilds,name',
            ],
            'slug' => [],
            'description' => [],
            'is_public' => [
                'boolean',
            ],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'El nombre del gremio es obligatorio.',
            'name.min' => 'El nombre debe tener al menos 3 caracteres.',
            'name.max' => 'El nombre no puede tener más de 50 caracteres.',
            'name.unique' => 'Ya existe un gremio con este nombre.',
            'description.required' => 'La descripción es obligatoria.',
            'description.min' => 'La descripción debe tener al menos 10 caracteres.',
            'description.max' => 'La descripción no puede tener más de 1000 caracteres.',
            'max_members.required' => 'El número máximo de miembros es obligatorio.',
            'max_members.min' => 'El gremio debe permitir al menos 5 miembros.',
            'max_members.max' => 'El gremio no puede tener más de 500 miembros.',
            'logo.image' => 'El logo debe ser una imagen.',
            'logo.mimes' => 'El logo debe ser un archivo jpeg, png, jpg, gif o webp.',
            'logo.max' => 'El logo no puede ser mayor a 2MB.',
            'banner.image' => 'El banner debe ser una imagen.',
            'banner.mimes' => 'El banner debe ser un archivo jpeg, png, jpg, gif o webp.',
            'banner.max' => 'El banner no puede ser mayor a 5MB.',
        ];
    }

    protected function prepareForValidation(): void
    {
        // Convertir checkboxes a boolean
        $this->merge([
            'is_public' => $this->boolean('is_public'),
            'is_recruiting' => $this->boolean('is_recruiting'),
        ]);
    }
}
