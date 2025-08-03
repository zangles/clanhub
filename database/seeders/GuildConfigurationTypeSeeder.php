<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;

final class GuildConfigurationTypeSeeder extends Seeder
{
    public function run()
    {
        $types = [
            // Recruitment
            [
                'key' => 'auto_accept_members',
                'name' => 'Auto-aceptar miembros',
                'description' => 'Acepta automáticamente solicitudes de membresía',
                'data_type' => 'boolean',
                'default_value' => 'false',
                'category' => 'recruitment',
                'requires_premium' => false,
            ],
            [
                'key' => 'require_application',
                'name' => 'Requiere aplicación',
                'description' => 'Los usuarios deben llenar una aplicación para unirse',
                'data_type' => 'boolean',
                'default_value' => 'true',
                'category' => 'recruitment',
                'requires_premium' => false,
            ],
            [
                'key' => 'min_level_required',
                'name' => 'Nivel mínimo requerido',
                'description' => 'Nivel mínimo del personaje para unirse',
                'data_type' => 'integer',
                'default_value' => '1',
                'validation_rules' => json_encode(['min' => 1, 'max' => 100]),
                'category' => 'recruitment',
                'requires_premium' => false,
            ],
            [
                'key' => 'recruitment_message',
                'name' => 'Mensaje de reclutamiento',
                'description' => 'Mensaje personalizado para nuevos miembros',
                'data_type' => 'text',
                'default_value' => '',
                'category' => 'recruitment',
                'requires_premium' => false,
            ],
            [
                'key' => 'application_questions',
                'name' => 'Preguntas de aplicación',
                'description' => 'Preguntas personalizadas para la aplicación',
                'data_type' => 'json',
                'default_value' => '[]',
                'category' => 'recruitment',
                'requires_premium' => true,
            ],

            // Permissions
            [
                'key' => 'allow_member_invites',
                'name' => 'Permitir invitaciones de miembros',
                'description' => 'Los miembros pueden invitar a otros usuarios',
                'data_type' => 'boolean',
                'default_value' => 'false',
                'category' => 'permissions',
                'requires_premium' => false,
            ],
            [
                'key' => 'show_member_list',
                'name' => 'Mostrar lista de miembros',
                'description' => 'Lista de miembros visible públicamente',
                'data_type' => 'boolean',
                'default_value' => 'true',
                'category' => 'permissions',
                'requires_premium' => false,
            ],

            // Appearance
            [
                'key' => 'custom_theme',
                'name' => 'Tema personalizado',
                'description' => 'Configuración de tema personalizado',
                'data_type' => 'json',
                'default_value' => '{}',
                'category' => 'appearance',
                'requires_premium' => true,
            ],
        ];

        foreach ($types as $type) {
            GuildConfigurationType::create($type);
        }
    }
}
