<?php

namespace App\Http\Controllers;

use App\Office;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $models = Office::all();
        return view('office.index',compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new Office();
        return view('office.create', compact('model'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        
       
        $validator = Validator::make($input, [
            'name' => 'required',
            'no_of_stretcher' => 'required',
        ]);
        
        
        if ($validator->fails()) {
            return redirect('office/create')->withErrors($validator)->withInput();
        }
        
        $model = new Office();
        $model->name = $input['name'];
        $model->no_of_stretcher = $input['no_of_stretcher'];
        
        $model->save();
        return redirect('office');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function show(Office $office)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Office::whereId($id)->first();
        if (empty($model)) {
            return abort('404');
        }
        return view('office.update', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        
        
        $validator = Validator::make($input, [
            'name' => 'required',
            'no_of_stretcher' => 'required',
        ]);
        
        
        if ($validator->fails()) {
            return redirect('office/edit'.$id)->withErrors($validator)->withInput();
        }
        
        $model = Office::whereId($id)->first();
        if (empty($model)) {
            return abort('404');
        }
        $model->name = $input['name'];
        $model->no_of_stretcher = $input['no_of_stretcher'];
        
        $model->save();
        return redirect('/office');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $model = Office::whereId($id)->first();
        if (empty($model)) {
            return abort('404');
        }
        $model->delete();
        return redirect('/office');
        
    }
}
