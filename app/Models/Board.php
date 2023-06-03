<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function components()
    {
        return $this->hasMany(Component::class);
    }

    public function getQty(int $productQty)
    {
       return $this->pivot->qty * $productQty;
    }
}
