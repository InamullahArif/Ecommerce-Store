<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'detail',
        'is_read',
    ];
    public function scopeApplyFilter($query, array $filters)
    {
        $filters = collect($filters);
        // dd($filters);
        if ($filters->get('search_by_name')) {
            $query->search($filters->get('search_by_name'));
        }
    }
    public function scopeSearch($query, $name)
    {
      return  $query->where('name', 'like', '%' . $name . '%');
    }
}
