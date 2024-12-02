<?php


namespace App\Utilities\Filter;



class Column extends QueryFilter implements FilterContract
{

    public function handle($column,$value): void
    {
        if (!is_null($value) && !is_null($column)){
            $search_column = explode('.',$column);
            if(count($search_column) == 2){
                $this->query->where($search_column[0].'.'.$search_column[1], 'LIKE', '%' . $value . '%');
            }elseif(count($search_column) == 3){
                $this->query->whereHas($search_column[1], function ($subQuery) use ($search_column,$value) {
                    $subQuery->where($search_column[0].'.'.$search_column[2], 'LIKE', '%' . $value . '%');
                });
            }else{
                $this->query->where($column, $value);
            }
        }
    }
}
