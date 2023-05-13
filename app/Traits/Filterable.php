<?php

namespace App\Traits;

use App\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

trait Filterable {

    /**
     *  Apply all relevant filter
     *
     * @param \Illuminate\Database\Eloquent\Builder
     * @param \App\Filters\Filter
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter(Builder $query, Filter $filter): Builder
    {
        return $filter->apply($query);
    }
}
