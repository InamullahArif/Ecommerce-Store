<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name',
        'second_name',
        'email',
        'phone_no',
        'country',
        'city',
        'zipCode',
        'shipping_address',
        'billing_address',
        'payment_method',
        'total_price',
        'data',
        'status',
        'order_id',
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
      return  $query->where('order_id', 'like', '%' . $name . '%');
    }
}
