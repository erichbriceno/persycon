<?php

namespace App;

use Illuminate\Support\Arr;

class Sortable
{
    protected $currentUrl;
    protected $currentColumn;
    protected $currentDirection;
    protected $query = [];

    public function __construct($currentUrl)
    {
        $this->currentUrl = $currentUrl;
    }

    public function appends(array $query)
    {
        $this->query = $query;
        $this->setCurrentOrder($this->query['order'] ?? null, $this->query['direction'] ?? 'asc');
    }

    protected function setCurrentOrder($order, $direction = 'asc')
    {
        $this->currentColumn = $order;
        $this->currentDirection = $direction;
    }

    public function url($column)
    {
        if ($this->isSortingBy($column, 'asc')) {
            return $this->buildSortableUrl($column, 'desc');
        }
        return $this->buildSortableUrl($column, 'asc');
    }

    protected function buildSortableUrl($column, $direction = 'asc')
    {
        return $this->currentUrl.'?'.Arr::query(array_merge(
            $this->query,
            [
                'order' => $column,
                'direction' => $direction
            ]));
    }

    public function classes($column)
    {
        if($this->isSortingBy($column, 'asc')) {
           return 'fa-caret-square-up';
        }

        if($this->isSortingBy($column, 'desc')) {
            return 'fa-caret-square-down';
        }

        return 'fa-sort';
    }

    protected function isSortingBy($column, $direction)
    {
        return $this->currentColumn == $column && $this->currentDirection == $direction;
    }
}