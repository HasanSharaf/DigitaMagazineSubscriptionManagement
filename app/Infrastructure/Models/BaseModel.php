<?php

namespace App\Infrastructure\Models;

use App\Utilities\Filter\FilterBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Request;

class BaseModel extends Model
{
    use SoftDeletes, HasFactory;

    public function scopeFilterBy($query, array $filters)
    {

        $filter = new FilterBuilder($query, $filters);
        $filter->apply();
    }
}
