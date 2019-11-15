<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    
    protected $table = 'office';
    protected $fillable = [
        'name',
        'no_of_stretcher',
        'created_by_id'
    ];
    
    
  
}
