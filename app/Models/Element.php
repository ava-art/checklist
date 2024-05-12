<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Element extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function elements(): HasMany
    {
        return $this->hasMany(Element::class);
    }
}
