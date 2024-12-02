<?php


namespace App\Utilities\Filter;


interface FilterContract
{
    public function handle($column,$value): void;
}
