<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Board extends Model
{
    use Filterable,
        HasFactory;

    protected $fillable = [
        'code',
        'type',
        'width',
        'heigth',
        'stocks'
    ];

    public function getSize(): string
    {
        return $this->width . 'X' . $this->heigth;
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}
