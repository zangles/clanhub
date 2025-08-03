<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('guild_configuration_types', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique(); // auto_accept_members, recruitment_message, etc
            $table->string('name');
            $table->text('description');
            $table->enum('data_type', ['boolean', 'string', 'integer', 'text', 'json']);
            $table->text('default_value')->nullable();
            $table->json('validation_rules')->nullable(); // min, max, required, etc
            $table->string('category'); // recruitment, permissions, appearance, etc
            $table->boolean('requires_premium');
            $table->boolean('is_active');
            $table->integer('sort_order');
            $table->timestamps();
        });
    }
};
