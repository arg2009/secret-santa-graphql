<?php

declare(strict_types=1);

namespace Tests\Unit\GraphQL\Mutations;

use App\GraphQL\Mutations\StartGame;
use App\Models\Game;
use App\Models\Player;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StartGameTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_starts_a_game():void
    {
        $game = Game::factory()->create();
        $players = Player::factory(['game_id' => $game->id])->count(2)->create();
        $player = $players->first();

        $this->graphQL('
        mutation ($player_id: String!) {
            startGame(player_id: $player_id) {
                id
            }
        }
        ',
            [
                'player_id'  => $player->id
            ]
        );

        $selectedPlayer = $player->refresh()->selectedPlayer;
        $this->assertSame(
            $selectedPlayer->game_id,
            $player->game_id,
        );
        $this->assertNotSame(
            $selectedPlayer->id,
            $player->id,
        );
    }

    public function test_it_does_not_select_a_player_when_one_is_selected():void
    {
        $game = Game::factory()->create();
        $players = Player::factory(['game_id' => $game->id])->count(2)->create();
        $player = $players->first();

        $this->graphQL('
        mutation ($player_id: String!) {
            startGame(player_id: $player_id) {
                id
            }
        }
        ',
            [
                'player_id'  => $player->id
            ]
        );

        $this->assertSame(
            $player->refresh()->selectedPlayer->game_id,
            $player->game_id,
        );
        $this->assertNotSame(
            $player->refresh()->selectedPlayer->id,
            $player->id,
        );

        $this->graphQL('
        mutation ($player_id: String!) {
            startGame(player_id: $player_id) {
                id
            }
        }
        ',
            [
                'player_id'  => $player->id
            ]
        );

        $this->assertNotSame(
            $player->refresh()->selectedPlayer->id,
            $player->id,
        );
    }
}
