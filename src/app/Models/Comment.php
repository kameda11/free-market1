<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'exhibition_id', 
        'user_name', 
        'comment'
    ];

    public function exhibition()
    {
        return $this->belongsTo(Exhibition::class);
    }
}
