<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory, Filterable;

    protected $fillable = [
        'name',
        'description',
        'code',
        'price',
        'category',
        'board_id',
        'estimate',
        'customer_id'
    ];

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function board()
    {
        return $this->belongsTo(Board::class);
    }

    public function components()
    {
        return $this->belongsToMany(Component::class)->withPivot('qty');
    }

    public function getBoardQty()
    {
        return $this->estimate * $this->pivot->quantity;
    }
}
