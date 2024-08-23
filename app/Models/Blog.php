<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Scout\Searchable;

class Blog extends Model
{
    use HasFactory,Searchable;
    protected $fillable = [
        "title",
        "author_name",
        "description",
        "slug",
        "created_by",
        "category_id",
        "qoute",
        "qoute_author_name",
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
        return ['title', 'description'];
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
      return  $query->where('title', 'like', '%' . $name . '%');
    }
    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($blog) {
            if (empty($blog->slug)) {
                $blog->slug = static::generateUniqueSlug($blog->title);
            }
        });
    }

    public static function generateUniqueSlug($title)
    {
        $slug = Str::slug($title, '-');
        $originalSlug = $slug;
        $count = 1;

        while (static::whereSlug($slug)->exists()) {
            $slug = "{$originalSlug}-{$count}";
            $count++;
        }

        return $slug;
    }


}
