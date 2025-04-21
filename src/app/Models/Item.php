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

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('like', 'comment');
    }

    public function condition()
    {
        return $this->belongsTo(Condition::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
