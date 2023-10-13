<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Workspec extends Model
{
    use HasFactory;

    // public function work(): BelongsTo
    // {
    //     return $this->belongsTo(Work::class);
    // }

    // public function outsourcing(): HasOne
    // {
    //     return $this->hasOne(Outsourcing::class);
    // }

}
