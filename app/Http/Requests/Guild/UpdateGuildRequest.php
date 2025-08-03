<?php

declare(strict_types=1);

namespace App\Http\Requests\Guild;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class UpdateGuildRequest extends FormRequest
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
        $guildId = $this->route('guild') ?
            \App\Domains\Guild\Models\Guild::where('slug', $this->route('guild'))->first()?->id :
            null;

        return [
            'name' => [
                'required',
                'string',
                'min:3',
                'max:50',
                Rule::unique('guilds', 'name')->ignore($guildId),
            ],
            'description' => [
                'required',
                'string',
                'min:10',
                'max:1000',
            ],
            'game' => [
                'required',
                'string',
                Rule::in([
                    'world-of-warcraft',
                    'final-fantasy-xiv',
                    'guild-wars-2',
                    'lost-ark',
                    'new-world',
                    'elder-scrolls-online',
                    'destiny-2',
                    'diablo-4',
                ]),
            ],
            'server' => [
                'required',
                'string',
                'max:100',
            ],
            'max_members' => [
                'required',
                'integer',
                'min:5',
                'max:500',
            ],
            'is_public' => [
                'boolean',
            ],
            'is_recruiting' => [
                'boolean',
            ],
            'logo' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,gif,webp',
                'max:2048',
            ],
            'banner' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,gif,webp',
                'max:5120',
            ],
            'settings.auto_accept_members' => [
                'boolean',
            ],
            'settings.require_application' => [
                'boolean',
            ],
            'settings.min_level_required' => [
                'integer',
                'min:1',
                'max:100',
            ],
            'settings.allow_member_invites' => [
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
            'server.required' => 'El servidor es obligatorio.',
            'server.max' => 'El nombre del servidor no puede tener más de 100 caracteres.',
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
