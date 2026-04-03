<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'category_id', 'brand_id', 'title', 'slug', 'sku',
        'price', 'sale_price', 'is_on_sale', 'sale_ends_at',
        'stock_qty', 'images', 'description', 'specs',
        'warranty', 'is_featured',
    ];

    protected $casts = [
        'images'       => 'array',
        'specs'        => 'array',
        'is_featured'  => 'boolean',
        'is_on_sale'   => 'boolean',
        'price'        => 'decimal:2',
        'sale_price'   => 'decimal:2',
        'sale_ends_at' => 'datetime',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getFirstImageAttribute(): ?string
    {
        return $this->images[0] ?? null;
    }

    public function isOnActiveSale(): bool
    {
        return $this->is_on_sale
            && $this->sale_price !== null
            && ($this->sale_ends_at === null || $this->sale_ends_at->isFuture());
    }

    public function getDiscountPercentAttribute(): ?int
    {
        if ($this->is_on_sale && $this->sale_price && $this->price > 0) {
            return (int) round((($this->price - $this->sale_price) / $this->price) * 100);
        }
        return null;
    }
}
