<?php

declare(strict_types=1);

use App\Domains\Guild\Enums\GuildMemberRole;
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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('guild_id')->constrained();
            $table->enum('role', array_column(GuildMemberRole::cases(), 'value'));
            $table->timestamp('joined_at')->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'guild_id']);
        });
    }
};
