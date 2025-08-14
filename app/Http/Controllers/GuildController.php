<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Domains\Guild\Services\GuildService;
use App\DTOs\dashboard\Elements\CardDTO;
use App\Http\Requests\Guild\CreateGuildRequest;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

final readonly class GuildController
{
    public function __construct(
        private GuildService $guildService
    ) {}

    public function index(Request $request): View
    {
        $search = $request->string('search')->toString();
        $game = $request->get('game');

        return view('guilds.create', compact('search', 'game'));
    }

    public function create(): View
    {
        $cardDto = CardDTO::make(
            title: [
                'title' => 'Crear gremio',
                'class' => 'text-white',
            ]
        );

        return view('guilds.create', [
            'cardDto' => $cardDto,
        ]);
    }

    public function store(CreateGuildRequest $request): RedirectResponse
    {
        try {
            $guild = $this->guildService->createGuild($request->validated());

            return redirect()
                ->route('guild.create', $guild->slug)
                ->with('success', '¡Gremio creado exitosamente!');

        } catch (Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }
}
