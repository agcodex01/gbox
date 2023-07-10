<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Customer extends Model
{
    use HasFactory, Filterable;

    protected $with = ['user'];

    public function user(): MorphOne
    {
        return $this->morphOne(User::class, 'userable');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
