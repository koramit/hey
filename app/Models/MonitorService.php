<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonitorService extends Model
{
    protected $fillable = ['name', 'webhook', 'notify', 'user_id'];

    public function uptimes()
    {
        return $this->hasMany(Uptime::class);
    }
}
