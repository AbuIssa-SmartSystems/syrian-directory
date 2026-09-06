<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'entity_id', 'rating'];

    // علاقة التقييم بالموقع (Entity)
    public function entity()
    {
        return $this->belongsTo(Entity::class, 'entity_id');
    }

    // علاقة التقييم بالمستخدم (User)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
