<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Velo extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function velos(): HasMany
    {
        return $this->HasMany(Velo::class);
    }
    // public function velos(): BelongsTo
    // {
    //     return $this->BelongsTo(Velo::class);
    // }
}
