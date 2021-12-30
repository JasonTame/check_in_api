<?php

namespace App\Models;

use App\Observers\ReminderObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Reminder extends Model
{

    protected $guarded = ['id'];

    /**
     * Get the Check In associated with this reminder
     *
     * @return HasOne
     */
    public function checkIn(): BelongsTo
    {
        return $this->belongsTo(CheckIn::class);
    }

    public static function boot()
    {
        parent::boot();

        Reminder::observe(ReminderObserver::class);
    }
}
