<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory, Sluggable;

    protected $casts = [
        'nutrients' => 'array',
        'ingredients' => 'array',
        'cautions' => 'array',
        'health_labels' => 'array',
        'diet_labels' => 'array',
        'cuisine_type' => 'array',
        'meal_type' => 'array',
        'dish_type' => 'array'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
