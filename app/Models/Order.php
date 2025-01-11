<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the products associated with the order.
     */
    public function products(): HasMany
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function transaction()
    {
        return $this->hasMany(OrderTransaction::class);
    }

    public function rider(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
