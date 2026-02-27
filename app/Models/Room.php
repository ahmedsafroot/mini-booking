<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Room extends Model
{
    protected $fillable=['hotel_id','name','price_per_night','max_occupancy','available_rooms'];

    public function hotel(): BelongsTo {
        return $this->belongsTo(Hotel::class);
    }
}
