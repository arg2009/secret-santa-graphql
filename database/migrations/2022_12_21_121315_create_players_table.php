<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name')->nullable(false);
            $table->uuid('selected_player_id')->nullable(true);
            $table->uuid('game_id')->nullable(false);
            $table->timestamps();

            $table
                ->foreign('game_id')
                ->references('id')
                ->on('games')
                ->cascadeOnDelete();
            $table
                ->foreign('selected_player_id')
                ->references('id')
                ->on('players')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('players');
    }
};
