<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Description extends Model
{
    use HasFactory;
    protected $fillable = [
        'description',
        'shipping_returns',
        'style_with',
        'product_id',
    ];
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
