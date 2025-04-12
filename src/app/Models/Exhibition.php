<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exhibition extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'detail',
        'category',
        'product_image',
        'condition',
        'price',
    ];

    protected $casts = [
        'condition' => 'integer',
        'price' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function purchas()
    {
        return $this->hasOne(Purchas::class);
    }
}
