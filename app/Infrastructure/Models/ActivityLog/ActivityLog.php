<?php

namespace App\Infrastructure\Models\ActivityLog;

use App\Infrastructure\Models\BaseModel;

class ActivityLog extends BaseModel
{

   protected $guarded = ['id'];
   
   protected $casts = [
      'details' => 'array',
   ];

}
