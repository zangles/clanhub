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
            'slug' => [
                'required',
                'string',
            ],
            'description' => [
                'nullable',
                'string',
            ],
            'is_public' => [
                'required',
                'boolean',
            ],
        ];
    }

    /**
     * @return array{name: string, slug: string, description: string|null, is_public: bool}
     */
    public function validated(mixed $key = null, mixed $default = null): array
    {
        /** @var array<string, mixed> $data */
        $data = parent::validated($key, $default);

        /** @var string $name */
        $name = $data['name'];

        /** @var string $slug */
        $slug = $data['slug'];

        /** @var string|null $description */
        $description = $data['description'] ?? null;

        /** @var bool $isPublic */
        $isPublic = $data['is_public'];

        return [
            'name' => $name,
            'slug' => $slug,
            'description' => $description,
            'is_public' => $isPublic,
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
            'slug.required' => 'El slug es obligatorio.',
            'description.required' => 'La descripción es obligatoria.',
            'description.min' => 'La descripción debe tener al menos 10 caracteres.',
            'description.max' => 'La descripción no puede tener más de 1000 caracteres.',
            'is_public.boolean' => 'El campo público debe ser verdadero o falso.',
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
