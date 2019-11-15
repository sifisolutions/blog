<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Appointment;
use Illuminate\Support\Facades\Validator;
use App\Office;
use App\WorkingHour;
use Auth;

class AppointmentController extends Controller
{
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = Appointment::all();
        return view('appointment.index', compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new Appointment();

        return view('appointment.create', compact('model'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'office_id' => 'required',
            'date' => 'required',
            'time' => 'required',
            'stretcher_no' => 'required',
            'is_save'=> 'required',
        ],[
            'is_save.required' => 'Office is closed'
                
            ]);

        if ($validator->fails()) {
            return redirect('appointment/create')->withErrors($validator)->withInput();
        }

        $model = new Appointment();
        $model->office_id = $input['office_id'];
        $model->date = $input['date'];
        $model->time = $input['time'];
        $model->stretcher_no = $input['stretcher_no'];
        $model->create_user_id =Auth::user()->id;

        $model->save();
        return redirect('/appointment');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Appointment::whereId($id)->first();
        if (empty($model)) {
            return abort('404');
        }
        return view('appointment.update', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'office_id' => 'required',
            'date' => 'required',
            'time' => 'required',
            'stretcher_no' => 'required',
            'is_save'=> 'required',
        ],[
            'is_save.required' => 'Office is closed'
            
        ]);
        
        if ($validator->fails()) {
            return redirect('appointment/create')->withErrors($validator)->withInput();
        }
        
        $model = Appointment::whereId($id)->first();
        if (empty($model)) {
            return abort('404');
        }
        $model->office_id = $input['office_id'];
        $model->date = $input['date'];
        $model->time = $input['time'];
        $model->stretcher_no = $input['stretcher_no'];
        $model->create_user_id =Auth::user()->id;
        
        $model->save();
        return redirect('/appointment');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Appointment::whereId($id)->first();
        if (empty($model)) {
            return abort('404');
        }
        $model->delete();
        return redirect('/appointment');
    }

    public function showStretcher($office_id, $date = null, $time = null,$id=null)
    {
        $data = [];
        $data['status'] = 'NOK';
        $appointment=[];
        $appointmentModel=[];
        $data['status'] = 'OK';
        $office = Office::where([
            'id' => $office_id
        ])->first();
        $workingHour = WorkingHour::where([
            'office_id' => $office_id
        ])->first();

        if (! empty($date) && !empty($time)) {
            $appointment = Appointment::where([
                'office_id' => $office_id,
                'date'=>$date
            ])->where('time', 'like',$time . '%')->pluck('stretcher_no')->toArray();
            
            if(!empty($id))
            {
                $appointmentModel= Appointment::where([
                    'id'=>$id,
                    'office_id' => $office_id,
                    'date'=>$date
                ])->where('time', 'like',$time . '%')->first();
            }
        }
        if (! empty($office)) {
            $data['status'] = 'OK';
            $data['html'] = view('appointment._stretche', compact('office','appointment','appointmentModel'))->render();
            if (! empty($workingHour)) {
                $html = "<input type='radio' name='type_id' value='0'><span>$workingHour->start_time - $workingHour->finish_time</span><br>";
                if ($workingHour->type_id == WorkingHour::TYPE_DIS_CONTINOUS) {
                    $html .= "<input type='radio' name='type_id' value='1'><span>$workingHour->start_time1 - $workingHour->finish_time1</span>";
                }
                $data['time'] = $html;
            }
        }
        return response($data);
    }

    public function checkDate($office_id, $date)
    {
        $data = [];
        $data['status'] = 'NOK';
        $data['error'] = "Office is closed on $date";

        $workingHour = WorkingHour::where([
            'office_id' => $office_id
        ])->first();
        if (! empty($workingHour)) {

            $day = date('l', strtotime($date));
            $day_of_week = date('N', strtotime($day));

            if (! empty($day_of_week)) {
                if (strpos($workingHour->days, $day_of_week) !== false) {
                    $data['status'] = 'OK';
                    $data['time'] = $workingHour->getTimeDropDown();
                }
            }
        }
        return response($data);
    }
    
    public function calender()
    {
        
       
        $data = Appointment::all();
      
        $events=[];
        if($data->count()){
            
            foreach ($data as $key => $value) {
                
               $startTime= "$value->date $value->time";
               $end=date('H:i',strtotime('+1 hour',strtotime($value->time)));
               $endTime= "$value->date $end";
               $events[$key] =[
                    'title'=>'Stretcher No '.$value->stretcher_no.'',
                   'start'=>$startTime,
                   'end'=> $endTime,
                   ];
                
            }
            
           
            
        }
        
      
       
        return view('appointment.calender', compact('events'));
    }
}
