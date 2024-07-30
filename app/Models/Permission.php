<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permission extends Model
{
    use HasFactory;
    protected $fillable = [
        'module_id',
    ];
    public function Module(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
