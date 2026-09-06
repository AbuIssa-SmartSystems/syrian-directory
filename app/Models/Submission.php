<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;

    protected $fillable = [
        'entity_name',
        'official_url',
        'description',
        'governorate',
        'category_name',
        'status',
    ];
}
