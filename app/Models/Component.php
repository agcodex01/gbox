<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'board_id'
    ];

    public function board()
    {
        return $this->belongsTo(Board::class);
    }

    public function ratio()
    {
        return $this->morphOne(Ratio::class, 'ratioable');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function getQtyByProductQty(int $productQty)
    {
        return $this->pivot->qty * $productQty;
    }

    public function getBoardQty(int $productQty)
    {
        return ($this->getQtyByProductQty($productQty) * $this->ratio->to) / $this->ratio->is;
    }
}
