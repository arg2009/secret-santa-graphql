<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Game extends Model
{
    use HasFactory;
    use HasUuids;

    protected $guarded = [
        'id',
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    public function players(): HasMany
    {
        return $this->hasMany(Player::class);
    }
}
