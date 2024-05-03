<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RentList extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $timestamps = false;
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function element(): BelongsTo
    {
        return $this->belongsTo(Elements::class);
    }
    public function client(): BelongsTo
    {
        return $this->belongsTo(Clients::class);
    }
}
