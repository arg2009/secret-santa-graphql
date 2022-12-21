<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Player extends Model
{
    use HasFactory;
    use HasUuids;

    protected $guarded = [
        'id',
    ];

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }
}
