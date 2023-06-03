<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ratio extends Model
{
    protected $fillable = [
        'is',
        'to',
    ];

    use HasFactory;

    public function ratioable()
    {
        return $this->morphTo();
    }
}
