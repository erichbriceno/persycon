<?php

namespace App\Queries;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

trait FiltersQueries
{
    protected $valid;

    public function filterBy(array $filters)
    {
        $rules = $this->filterRules();

        $validator = Validator::make(array_intersect_key($filters, $rules), $rules);

        $this->valid = $validator->valid();

        foreach ($this->valid as $name => $value)
        {
            $this->applyFilter($name, $value);
        }

        return $this;
    }

    public function applyFilter($name, $value): void
    {
        $method = 'filterBy' . Str::studly($name);

        if (method_exists($this, $method)) {
            $this->$method($value);
        } else {
            $this->where($name, $value);
        }
    }
}