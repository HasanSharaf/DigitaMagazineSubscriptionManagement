<?php


namespace App\Utilities\Filter;


use Illuminate\Database\Schema\Builder;
use Illuminate\Support\Facades\Request;

class FilterBuilder
{
    protected $query;
    protected $filters;
    public function __construct($query, $filters)
    {
        $this->query = $query;
        $this->filters = $filters;
    }

    public function apply()
    {
        foreach ($this->filters as $name => $value) {
            (new Column($this->query))->handle($name,$value);
        }

        return $this->query;
    }



}
