<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Jobs\ResolveAuditGeo;

class Audit extends Model
{
    protected static function booted()
    {
        static::created(function ($audit) {
            ResolveAuditGeo::dispatch($audit);
        });
    }

    // Accessor para retornar geo como array
    public function getGeoDataAttribute(): ?array
    {
        return $this->geo ? json_decode($this->geo, true) : null;
    }
}