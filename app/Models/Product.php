<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Scout\Searchable;
class Product extends Model
{
    use HasFactory,Searchable;
    protected $fillable = [
        'name',
        'rating',
        'category_id',
        'price',
        'slug',
    ];
    // public function toSearchableArray()
    // {
    //     $array = $this->toArray();
    //     return $array;
    // }
    // public function toSearchableArray()
    // {
    //     return array_merge($this->toArray(),[
    //         'id' => (string) $this->id,
    //         'created_at' => $this->created_at->timestamp,
    //     ]);
    // }
    public static function searchableFields()
    {
        return ['name'];
    }
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($product) {
            if (empty($product->slug)) {
            $product->slug = static::generateUniqueSlug($product->name);
            }
        });
    }

    public static function generateUniqueSlug($name)
    {
        $slug = Str::slug($name, '-');
        $originalSlug = $slug;
        $count = 1;

        while (static::whereSlug($slug)->exists()) {
            $slug = "{$originalSlug}-{$count}";
            $count++;
        }

        return $slug;
    }
    // public function image(): MorphOne
    // {
    //     return $this->morphOne(Image::class, 'imageable');
    // }
    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }
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
    public function quantities(): HasMany
    {
        return $this->hasMany(Quantity::class);
    }
    public function description(): HasOne
    {
        return $this->hasOne(Description::class);
    }
}
