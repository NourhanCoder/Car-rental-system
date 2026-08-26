<?php

namespace App\Models;

use App\Enums\CarStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Car extends Model
{
    protected $fillable = [
        'category_id',
        'title',
        'content',
        'luggage',
        'doors',
        'passengers',
        'price',
        'discount_price',
        'image',
        'is_active',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'price' => 'decimal:2',
            'discount_price' => 'decimal:2',
            'status' => CarStatus::class, // Auto-cast Enum
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
