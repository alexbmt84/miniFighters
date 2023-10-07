<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Marketplace extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function isInMarketPlace($fighterId) {
        return Marketplace::query()->where('fighter_id', $fighterId)->exists();
    }

}
