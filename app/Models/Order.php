<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
     * Get the rider associated with the order.
     */
    public function rider()
    {
        return $this->belongsTo(User::class, 'rider_id');
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
}
