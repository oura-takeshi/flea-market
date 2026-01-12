<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

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

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function comments()
    {
        return $this->belongsToMany(Item::class, 'comments')->withPivot('content');
    }

    public function likes()
    {
        return $this->belongsToMany(Item::class, 'likes');
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    public function chats()
    {
        return $this->hasManyThrough(Chat::class, Purchase::class);
    }

    public function chatMessages()
    {
        return $this->hasMany(ChatMessage::class);
    }

    public function writtenReviews()
    {
        return $this->hasMany(Review::class, 'reviewer_id');
    }

    public function receivedReviews()
    {
        return $this->hasMany(Review::class, 'reviewee_id');
    }

    public function activeChats()
    {
        $user_id = $this->id;

        return Chat::where('is_finished', false)
        ->whereHas('purchase', function ($q) use ($user_id) {
            $q->where('user_id', $user_id)
            ->orWhereHas('item', function ($sub) use ($user_id) {
                $sub->where('user_id', $user_id);
            });
        });
    }

    public function visibleActiveChats()
    {
        $user_id = $this->id;

        return $this->activeChats()
        ->where(function ($q) use ($user_id) {
            $q->whereDoesntHave('reviews', function ($sub) use ($user_id) {
                $sub->where('reviewer_id', $user_id);
            });
        });
    }

    public function visibleActiveChatsWithUnreadCount()
    {
        $user_id = $this->id;

        return $this->visibleActiveChats()
        ->withCount(['chatMessages as unread_count' => function ($q) use ($user_id) {
            $q->where('is_read', false)
            ->where('user_id', '!=', $user_id);
        }])
        ->withMax('chatMessages', 'created_at')
        ->orderByDesc('chat_messages_max_created_at');
    }

    public function averageReviewScore(): ?int
    {
        $avg = $this->receivedReviews()->avg('score');

        if ($avg === null) {
            return null;
        }

        return (int) round($avg);
    }
}
