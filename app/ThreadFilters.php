<?php
namespace App;

use Illuminate\Database\Eloquent\Builder;

class ThreadFilters extends Filter
{
    public function tags($value = 1)
    {
        $this->builder->whereHas('tags', function ($query) use ($value) {
            $query->where('tag_id', $value);
        });
    }

    public function user($value)
    {
        $this->builder->where('user_id', $value);
    }
}
