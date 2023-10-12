<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function games()
    {
        return $this->belongsToMany(Game::class, 'games_users');
    }

    public function fighters() {
        return $this->hasMany(Fighter::class);
    }

    public function incrementWallet($amount) {
        $this->wallet += $amount;
        $this->save();
    }

    public function decrementWallet($amount) {
        $this->wallet -= $amount;
        $this->save();
    }

    public function friendsOfMine()
    {
        return $this->belongsToMany('App\Models\User', 'friendships', 'user_id', 'friend_id')
            ->wherePivot('status', 1)
            ->withPivot('status')
            ->withTimestamps();
    }

    public function friendOf()
    {
        return $this->belongsToMany('App\Models\User', 'friendships', 'friend_id', 'user_id')
            ->wherePivot('status', 1)
            ->withPivot('status')
            ->withTimestamps();
    }

    public function getFriendsListAttribute()
    {
        return $this->friendsOfMine->merge($this->friendOf);
    }


// Invitations envoyées
    public function friendRequests()
    {
        return $this->belongsToMany('App\Models\User', 'friendships', 'user_id', 'friend_id')
            ->wherePivot('status', 0)
            ->withPivot('status')
            ->withTimestamps();
    }

// Invitations reçues
    public function friendRequestsPending()
    {
        return $this->belongsToMany('App\Models\User', 'friendships', 'friend_id', 'user_id')
            ->wherePivot('status', 0)
            ->withPivot('status')
            ->withTimestamps();

    }

    public function sendFriendRequestTo(User $user)
    {
        $this->friendRequests()->attach($user->id);
    }

    public function hasSentFriendRequestTo(User $user)
    {
        return $this->friendRequests->contains($user->id);
    }


    public function acceptFriendRequestFrom(User $user)
    {
        return $this->friendRequestsPending()->where('users.id', $user->id)->first()->pivot->update(['status' => 1]);
    }

    public function declineFriendRequestFrom(User $user)
    {
        return $this->friendRequestsPending()->where('users.id', $user->id)->first()->pivot->update(['status' => 2]);
    }

    public function isFriendsWith(User $user)
    {
        return $this->friendsList->contains($user->id);
    }

}
