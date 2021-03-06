<?php


namespace App\Queries;


use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

abstract class QueryFilter
{
    protected $valid = [];

    abstract public function rules(): array;

    public function applyTo($query, array $filters)
    {
        $rules = $this->rules();

        $validator = Validator::make(array_intersect_key($filters, $rules), $rules);

        $this->valid = $validator->valid();

        foreach ($this->valid as $name => $value)
        {
            $this->applyFilter($query, $name, $value);
        }

        return $query;
    }

    public function applyFilter($query, $name, $value): void
    {
        $method = 'filterBy' . Str::studly($name);

        if (method_exists($this, $method)) {
            $this->$method($query, $value);
        } else {
            $query->where($name, $value);
        }
    }

    public function valid()
    {
        return $this->valid;
    }
}