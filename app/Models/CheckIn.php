<?php

namespace App\Models;

use App\Observers\CheckInObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CheckIn extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * Get the reminder linked to this Check In
     *
     * @return HasOne
     */
    public function reminder(): HasOne
    {
        return $this->hasOne(Reminder::class);
    }

    /**
     * Get the user that this check in belongs to
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function boot()
    {
        parent::boot();

        CheckIn::observe(CheckInObserver::class);
    }
}
