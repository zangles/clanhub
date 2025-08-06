<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Domains\Guild\Services\GuildService;
use App\DTOs\dashboard\Elements\CardDTO;
use App\Http\Requests\Guild\CreateGuildRequest;
use App\Http\Requests\Guild\UpdateGuildRequest;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

final class GuildController
{
    public function __construct(
        private GuildService $guildService
    ) {}

    public function index(Request $request): View
    {
        $search = $request->string('search')->toString();
        $game = $request->get('game');

        if ($search) {
            $guilds = $this->guildService->searchGuilds($search);
        } else {
            $guilds = $this->guildService->getPublicGuilds();
        }

        return view('guilds.index', compact('guilds', 'search', 'game'));
    }

    public function show(string $slug): View
    {
        $guild = $this->guildService->findGuildBySlug($slug);

        if (! $guild) {
            abort(404, 'Gremio no encontrado');
        }

        return view('guilds.show', compact('guild'));
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
                ->route('guilds.show', $guild->slug)
                ->with('success', '¡Gremio creado exitosamente!');

        } catch (Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    public function edit(string $slug): View
    {
        $guild = $this->guildService->findGuildBySlug($slug);

        if (! $guild) {
            abort(404, 'Gremio no encontrado');
        }

        if (! $guild->isOwner(auth()->id())) {
            abort(403, 'No tienes permisos para editar este gremio');
        }

        $games = [
            'world-of-warcraft' => 'World of Warcraft',
            'final-fantasy-xiv' => 'Final Fantasy XIV',
            'guild-wars-2' => 'Guild Wars 2',
            'lost-ark' => 'Lost Ark',
            'new-world' => 'New World',
            'elder-scrolls-online' => 'The Elder Scrolls Online',
            'destiny-2' => 'Destiny 2',
            'diablo-4' => 'Diablo IV',
        ];

        return view('guilds.edit', compact('guild', 'games'));
    }

    public function update(UpdateGuildRequest $request, string $slug): RedirectResponse
    {
        try {
            $guild = $this->guildService->findGuildBySlug($slug);

            if (! $guild) {
                abort(404, 'Gremio no encontrado');
            }

            $updatedGuild = $this->guildService->updateGuild($guild, $request->validated());

            return redirect()
                ->route('guilds.show', $updatedGuild->slug)
                ->with('success', 'Gremio actualizado exitosamente');

        } catch (Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    public function destroy(string $slug): RedirectResponse
    {
        try {
            $guild = $this->guildService->findGuildBySlug($slug);

            if (! $guild) {
                abort(404, 'Gremio no encontrado');
            }

            $this->guildService->deleteGuild($guild);

            return redirect()
                ->route('guilds.index')
                ->with('success', 'Gremio eliminado exitosamente');

        } catch (Exception $e) {
            return redirect()
                ->back()
                ->with('error', $e->getMessage());
        }
    }

    public function myGuilds(): View
    {
        $guilds = $this->guildService->getUserGuilds();

        return view('guilds.my-guilds', compact('guilds'));
    }
}
