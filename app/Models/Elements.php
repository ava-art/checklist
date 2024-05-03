<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Elements extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'sort',
        'name',
        'color',
        'name_en',
        'image',
        'transmissia',
        'koleso',
        'rama',
        'go',
        'repair',
        'shield',
        'sort',
        'qr',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
   
}
