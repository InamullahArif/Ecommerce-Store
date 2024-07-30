<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as ModelsRole;
use Spatie\Permission\Traits\HasRoles;


class Role extends ModelsRole
{
    use HasFactory;
    protected $fillable = [
    'name',
    ];

    protected $attributes = [
        'guard_name' => 'web',
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
