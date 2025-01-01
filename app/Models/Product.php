<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class product extends Model
{
    use Sluggable;

    protected $fillable = ['name', 'slug', 'category_id', 'price', 'currency_id', 'stock', 'discount_id', 'status', 'image'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    public function discount(): BelongsTo
    {
        return $this->belongsTo(Discount::class);
    }

        public function cart(): HasMany
    {
        return $this->hasMany(Cart::class);
    }

    public function scopeFilter(Builder $query, array $filters): void
    {
        $query->when(
            $filters['search'] ?? false, 
            fn ($query, $search) => 
            $query->where('name', 'like', '%' . $search . '%')
        );

        $query->when(
            $filters['category'] ?? false,
            fn ($query, $category) =>
            $query->whereHas('category', fn ($query) => $query->where('slug', $category))
        );

        $query->when(
            $filters['currency'] ?? false,
            fn ($query, $currency) =>
            $query->whereHas('currency', fn ($query) => $query->where('slug', $currency))
        );
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
