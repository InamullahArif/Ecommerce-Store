<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Navbar extends Model
{
    use HasFactory;
    protected $fillable = [
        'data',
    ];
    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
