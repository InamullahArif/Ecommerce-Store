<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Quantity extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_quantity',
        'product_id',
        'color_id',
        'size_id',
    ];
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
    public function color(): BelongsTo
    {
        return $this->belongsTo(Color::class);
    }
    public function size(): BelongsTo
    {
        return $this->belongsTo(Size::class);
    }
}
