<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditingTrait;


class Permission extends Model implements Auditable
{
    use HasFactory, HasUuids, AuditingTrait;

    protected  $fillable = [
        'name',
        'description',
    ];


    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}