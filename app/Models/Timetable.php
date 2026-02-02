<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Timetable extends Model
{
    use Notifiable;

    public function routeNotificationForDiscord()
    {
        return 1467836613211193399;
    }
}
