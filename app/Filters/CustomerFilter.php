<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class CustomerFilter extends Filter
{
    public function search($value)
    {
        if ($value) {
            return $this->builder->whereHas('user', function (Builder $query) use ($value) {
                $query->where($this->keyQuery, 'like', "%$value%");
            });
        }

        return $this->builder;
    }
}
