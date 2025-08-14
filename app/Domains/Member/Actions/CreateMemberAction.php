<?php

declare(strict_types=1);

namespace App\Domains\Member\Actions;

use App\Domains\Member\DTOs\CreateMemberDTO;
use App\Domains\Member\Models\Member;
use Carbon\Carbon;

final class CreateMemberAction
{
    public function handle(CreateMemberDTO $data): Member
    {
        return Member::create([
            'user_id' => $data->userId,
            'guild_id' => $data->guildId,
            'role' => $data->role,
            'joined_at' => Carbon::now(),
        ]);
    }
}
