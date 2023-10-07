<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Fighter extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'avatar_path', 'hp', 'attack_name_1', 'attack_name_2', 'attack_damages_1', 'attack_damages_2', 'user_id', 'description'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function marketplace(): BelongsTo {
        return $this->belongsTo(Marketplace::class);
    }

    public static function listForSale($fighterId) {

        $fighter = Fighter::query()->where('id', $fighterId)->first();

        if ($fighter->user_id == auth()->id()) {

            $listing = new Marketplace;
            $listing->fighter_id = $fighterId;
            $listing->user_id = auth()->id();
            $listing->price = 400;


            $listing->save();

        }

    }

}
