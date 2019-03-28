<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Filter extends Model
{
    protected $request;
    protected $builder;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    public function apply(Builder $builder)
    {
        $this->builder = $builder;
        foreach ($this->filters() as $name => $value) {
            if (method_exists($this, $name)) {
                $this->$name(array_filter([$value]));
            }
        }
    }
    public function filters()
    {
        return $this->request->all();
    }
}
