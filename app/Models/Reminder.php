<?php

namespace App\Models;

use App\Observers\ReminderObserver;
use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{

    protected $guarded = ['id'];

    public static function boot()
    {
        parent::boot();

        Reminder::observe(ReminderObserver::class);
    }
}
