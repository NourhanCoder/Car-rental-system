<?php

namespace App\Models;

use App\Enums\BookingStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'car_id',
        'pick_up_date',
        'drop_off_date',
        'total_price',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'pick_up_date' => 'datetime',
            'drop_off_date' => 'datetime',
            'total_price' => 'decimal:2',
            'status' => BookingStatus::class,
        ];
    }

   
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    
    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }

   
    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }
}
