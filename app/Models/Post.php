<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'body',
        'excerpt',
        'thumbnail',
        'slug',
        'category_id',
        'author_id',
        'user_id'
    ];

    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class);
    }


    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comment(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, fn ($query, $search) =>
            $query->where(fn($query)=>
                $query->where('title', 'LIKE', '%' . $search . '%')
                ->orWhere('body', 'LIKE', '%' . $search . '%'))
        );

        $query->when($filters['category'] ?? false, fn ($query, $category) =>
        $query
            ->whereHas('category' , fn($query) => $query->where('slug' , $category)));


        $query->when($filters['author'] ?? false, fn ($query, $author) =>
        $query
            ->whereHas('author' , fn($query) => $query->where('username' , $author)));
    }
}
