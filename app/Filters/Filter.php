<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class Filter
{

    protected string $keyQuery = 'name';

    /**
     *  The request instance
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     *  The builder instance
     *
     * @var \Illuminate\Database\Eloquent\Builder
     */
    protected $builder;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     *  Apply the filter in the builder
     *
     * @param \Illuminate\Database\Eloquent\Builder
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(Builder $builder): Builder
    {
        $this->builder = $builder;

        foreach ($this->request->all() as $key => $value) {
            if (method_exists($this, $key) && !is_null($value)) {
                call_user_func_array([$this, $key], array_filter([$value]));
            }
        }

        return $this->builder;
    }

    public function size(int $value): Builder
    {
        if ($value > 0) {
            $this->builder->getModel()?->setPerPage($value);
        }

        return $this->builder;
    }


    public function search(mixed $value)
    {
        return $value != null
            ? $this->builder->where($this->keyQuery, 'like', "%$value%")
            : $this->builder;
    }
}
