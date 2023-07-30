<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Mobil extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = [
        'nopol', 'nama_mobil', 'cover', 'slug', 'harga'
    ];

    public function sluggable(): array{
        return[
            'slug' => [
                'source' => 'nopol'
            ]
            ];
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class,'mobil_category', 'mobil_id', 'category_id' );
    }
    public function rentlog()
    {
        return $this->hasMany(Rent_log::class);
    }
}
