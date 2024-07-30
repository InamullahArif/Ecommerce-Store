<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'username',
        'email',
        'content',
        'blog_id',
        'parent_id',
        'status',
        'slug'
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
      return  $query->where('content', 'like', '%' . $name . '%');
    }
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($comment) {
            if (empty($comment->slug)) {
                $comment->slug = static::generateUniqueSlug($comment->content);
            }
        });
    }

    public static function generateUniqueSlug($content)
{
    $words = explode(' ', $content);
    $words = array_slice($words, 0, 6);
    $partialContent = implode(' ', $words);
    $slug = Str::slug($partialContent, '-');
    $originalSlug = $slug;
    $count = 1;
    while (static::whereSlug($slug)->exists()) {
        $slug = "{$originalSlug}-{$count}";
        $count++;
    }

    return $slug;
}
}
