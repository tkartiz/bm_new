<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Work extends Model
{
    use HasFactory;

    public function application(): BelongsTo
    {
        return $this->belongsTo(Application::class);
    }

    // public function workspec(): HasOne
    // {
    //     return $this->hasOne(Workspec::class);
    // }

}
