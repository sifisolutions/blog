<?php
namespace App\Http\Controllers;

use App\WorkingHour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WorkingHourController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = WorkingHour::all();
        return view('working-hour.index', compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new WorkingHour();
        return view('working-hour.create', compact('model'));
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

        $validator = validator::make($input, [
            'office_id' => 'required',
            'days' => 'required',
            'type_id' => 'required',
            'start_time' => 'required',
            'finish_time' => [
                'required',
                function ($attribute, $value, $fail) use ($input) {
                    $start = strtotime($input['start_time']);
                    $end = strtotime($input['finish_time']);
                    if ($start >= $end) {
                        $fail('End Time can not be less than start time');
                    }
                }
            ],
            'finish_time1' => [
                function ($attribute, $value, $fail) use ($input) {
                    $start = strtotime($input['start_time1']);
                    $end = strtotime($input['finish_time1']);
                    if ($input['type_id'] == WorkingHour::TYPE_DIS_CONTINOUS) {
                        if ($start >= $end) {
                            $fail('End Time can not be less than start time');
                        }
                    }
                }
            ]
        ]);

        if ($validator->fails()) {
            return redirect('working-hour/create')->withErrors($validator)->withInput();
        }

        $model = new WorkingHour();
        $model->office_id = $input['office_id'];
        $model->days = implode(',', $input['days']);
        $model->type_id = $input['type_id'];
        $model->start_time = $input['start_time'];
        $model->finish_time = $input['finish_time'];
        $model->start_time1 = $input['start_time1'];
        $model->finish_time1 = $input['finish_time1'];

        $model->save();
        return redirect('working-hour');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\WorkingHour $workingHour
     * @return \Illuminate\Http\Response
     */
    public function show(WorkingHour $workingHour)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\WorkingHour $workingHour
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = WorkingHour::whereId($id)->first();
        if (empty($model)) {
            return abort('404');
        }
        return view('working-hour.update', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\WorkingHour $workingHour
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();

        $validator = validator::make($input, [
            'office_id' => 'required',
            'days' => 'required',
            'type_id' => 'required',
            'start_time' => 'required',
            'finish_time' => [
                'required',
                function ($attribute, $value, $fail) use ($input) {
                    $start = strtotime($input['start_time']);
                    $end = strtotime($input['finish_time']);
                    if ($start >= $end) {
                        $fail('End Time can not be less than start time');
                    }
                }
            ],
            'finish_time1' => [
                function ($attribute, $value, $fail) use ($input) {
                    $start = strtotime($input['start_time1']);
                    $end = strtotime($input['finish_time1']);
                    if ($input['type_id'] == WorkingHour::TYPE_DIS_CONTINOUS) {
                        if ($start >= $end) {
                            $fail('End Time can not be less than start time');
                        }
                    }
                }
            ]
        ]);

        if ($validator->fails()) {
            return redirect('working-hour/edit/' . $id)->withErrors($validator)->withInput();
        }

        $model = WorkingHour::whereId($id)->first();
        if (empty($model)) {
            return abort('404');
        }
        $model->office_id = $input['office_id'];
        $model->days = implode(',', $input['days']);
        $model->type_id = $input['type_id'];
        $model->start_time = $input['start_time'];
        $model->finish_time = $input['finish_time'];
        $model->start_time1 = $input['start_time1'];
        $model->finish_time1 = $input['finish_time1'];

        $model->save();
        return redirect('/working-hour');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\WorkingHour $workingHour
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = WorkingHour::whereId($id)->first();
        if (empty($model)) {
            return abort('404');
        }
        $model->delete();
        return redirect('/working-hour');
    }
}
