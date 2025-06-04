<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'condition_id',
        'image',
        'name',
        'brand',
        'price',
        'number_likes',
        'number_comments',
        'description'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->belongsToMany(User::class, 'comments')->withPivot('content');
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, 'likes');
    }

    public function condition()
    {
        return $this->belongsTo(Condition::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function purchase()
    {
        return $this->hasOne(Purchase::class);
    }
}
