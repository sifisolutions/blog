<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkingHour extends Model
{
    const SUNDAY = 7;
    const MONDAY = 1; 
    const TUESDAY = 2; 
    const WEDNESDAY = 3; 
    const THURSDAY = 4; 
    const FRIDAY = 5; 
    const SATURDAY = 6; 
    
    
    const TYPE_CONTINOUS=0;
    
    const TYPE_DIS_CONTINOUS=1;
    
    protected $table = 'working_hour';
    protected $fillable = [
        'office_id',
        'days',
        'type_id',
        'start_time',
        'finish_time',
        'start_time1',
        'finish_time1'
    ];
    
    public static function getDaysList($day=null)
    {
        $list= [
            self::SUNDAY => 'Sunday',
            self::MONDAY => 'Monday',
            self::TUESDAY => 'Tuesday',
            self::WEDNESDAY => 'Wednesday',
            self::THURSDAY => 'Thursday',
            self::FRIDAY => 'Friday',
            self::SATURDAY => 'Saturday',
            
        ];
        if($day===null){
            
            return $list;
        }
        return isset($list[$day])?$list[$day]:'';
    }
    
    public static function getType($type=null)
    {
        $list= [
            self::TYPE_CONTINOUS => 'Continous',
            self::TYPE_DIS_CONTINOUS => 'Dis-Continous',
            
        ];
        if($type===null){
            
            return $list;
        }
        return isset($list[$type])?$list[$type]:'';
    }
    public  function getDays()
    {
        $daysName=[];
        $selectedModels= explode(',',$this->days);
        if(!empty($selectedModels)){
        foreach($selectedModels as $val){
           $daysName[]= $this->getDaysList($val);
        }
        }
        if(!empty($daysName)){
            return implode(',',$daysName);
        }
        return '';
    }
    
    public static function getOfficeList()
    {
        // cdump($filterOnly);
 
           
            $model = Office::all();
      
        return $model->pluck('name', 'id');
    }
    
    public static function checkedArray($name, $value, $selectedModels = null, $attr = null)
    {
        
       
        if ($selectedModels !== null && old($name) === null) {
            $selectedVal = [];
            $selectedModels= explode(',',$selectedModels);
   
            return in_array($value, $selectedModels) ? 'checked' : '';
        }
        return is_array(old($name)) && in_array($value, old($name)) ? 'checked' : '';
    }
    
    public function office()
    {
        return $this->hasOne('App\Office', 'id', 'office_id');
    }
    
    public function getTime()
    {
        $title= $this->start_time .'-'. $this->finish_time;  
        if($this->type_id==self::TYPE_DIS_CONTINOUS)
        {
            $title.=" break ";
            
            $title.=$this->start_time1 .'-'. $this->finish_time1;
        }
     return $title;
        
    }
    
    
    public function getTimeDropDown()
    {
        $output=[];
        $open_time = strtotime($this->start_time);
        $close_time = strtotime($this->finish_time);
        for( $i=$open_time; $i<$close_time; $i+=3600) {
            $startTime= date("H:i",$i);
            $key= date("H:i:s",$i);
            $endTime= date('H:i',strtotime('+1 hour',strtotime($startTime)));
            $output[$key]= $startTime .' - '.$endTime;
          
        }
        
        if($this->type_id==self::TYPE_DIS_CONTINOUS)
        {
            $open_time = strtotime($this->start_time1);
            $close_time = strtotime($this->finish_time1);
            for( $i=$open_time; $i<$close_time; $i+=3600) {
                $startTime= date("H:i",$i);
                $key= date("H:i:s",$i);
                $endTime= date('H:i',strtotime('+1 hour',strtotime($startTime)));
                $output[$key]= $startTime .' - '.$endTime;
                
            }
            
        }
        
       return $output;
    }
}
