<?php

namespace App\Models;

use App\Contracts\HasRole;
use App\Traits\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Staff extends Model implements HasRole
{
    use HasFactory, Role;

    protected $table = 'staffs';

    protected $fillable = [
        'role'
    ];

    public function getRoleType(): string
    {
        return $this->role;
    }

    public function user(): MorphOne
    {
        return $this->morphOne(User::class, 'userable');
    }
}
