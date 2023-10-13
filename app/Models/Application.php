<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subject',
        'works_quantity',
        'severity',
        'revision',
        'applicated_at',
        'desired_dlvd_at',
    ];

    public function work(): HasMany
    {
        return $this->hasMany(Work::class, 'application_id', 'id');
    }

}
