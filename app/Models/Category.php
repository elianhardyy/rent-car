<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;
    use sluggable;
    
    protected $fillable =[
        'name', 'slug'
    ];

    public function sluggable(): array{
        return[
            'slug' => [
                'source' => 'name'
            ]
            ];
    }
}
