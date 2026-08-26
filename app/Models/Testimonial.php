<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Testimonial extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'position',
        'content',
        'image',
        'is_published',
    ];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
