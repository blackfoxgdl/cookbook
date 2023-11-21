<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recipes extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'recipe', 'instructions', 'ingredients', 'price'
    ];

    protected $dates = ['deleted_at'];
}
