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
        Schema::create('guild_configurations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guild_id')->constrained();
            $table->foreignId('configuration_type_id')->constrained('guild_configuration_types');
            $table->text('value');
            $table->timestamps();

            $table->unique(['guild_id', 'configuration_type_id']);
            $table->index('guild_id');
        });
    }
};
