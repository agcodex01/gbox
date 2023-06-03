<?php

namespace App\Filters;

class ApiFilter extends Filter
{
    public function customerId($value)
    {
        if ($value) {
            return $this->builder->where('customer_id', $value);
        }

        return $this->builder;
    }
}
