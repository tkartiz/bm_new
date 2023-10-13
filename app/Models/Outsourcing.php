<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Outsourcing extends Model
{
    use HasFactory;

    // public function workspec(): BelongsTo
    // {
    //     return $this->belongsTo(Workspec::class);
    // }
}
