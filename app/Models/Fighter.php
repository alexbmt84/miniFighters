<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fighter extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'avatar_path', 'hp', 'attack_name_1', 'attack_name_2', 'attack_damages_1', 'attack_damages_2', 'user_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }

}
