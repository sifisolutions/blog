<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $table = 'appointment';
    protected $fillable = [
        'office_id',
        'date',
        'time',
        'stretcher_no',
        'type_id',
        'create_user_id',
        
    ];
    
    public function office()
    {
        return $this->hasOne('App\Office', 'id', 'office_id');
    }
}
