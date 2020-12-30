<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Uptime extends Model
{
    public $timestamps = false;

    protected $fillable = ['monitor_service_id', 'online', 'timestamp'];

    protected $casts = ['timestamp' => 'datetime'];

    public function monitorService()
    {
        return $this->belongsTo(MonitorService::class);
    }
}
