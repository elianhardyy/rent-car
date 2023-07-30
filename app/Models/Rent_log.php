<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rent_log extends Model
{
    use HasFactory;
    use Sluggable;
    public $timestamps = true;
 
    public $fillable = ['user_id','mobil_id','rent_date','KTP','SIM','slug'];
    public function sluggable(): array{
        return [
            'slug'=>[
                'source'=>'KTP'
                ]
            ];
        }
    public function user()
    {
        return $this->belongsTo(User::class,"user_id");
    }
    public function mobil()
    {
        return $this->belongsTo(Mobil::class,'mobil_id');
    }
}
