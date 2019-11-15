@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class ="btn_right" ><a href="{{ route('appointment.create') }}" class="btn btn-success">Create Appointment </a></div>
                
                 

               
               <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Office</th>
                <th>Date</th>
                <th>Time</th>
                <th>Stretcher No</th>
                  <th>Action</th>
                
            </tr>
        </thead>
        <tbody>
            
            
            
              @if ($models)
		
				@foreach ($models as $model)
				<tr>
				<td>
				{{ isset($model->office->name)?$model->office->name:'' }}
				</td>
				<td> {{$model->date}} </td>
				
				
				 <td> {{$model->time}}  </td>
				 <td>  Stretcher No {{$model->stretcher_no}}</td>
				 <td>  <a href="{{ route('appointment.edit', ['id' => $model->id]) }}" data-toggle="tooltip" data-original-title="Edit"> 
                    	Edit
                    </a>
                    <a href="{{ route('appointment.destroy',['id' => $model->id]) }}" data-toggle="tooltip" data-original-title="Delete"> 
                    	Delete
                    	</td>
				 </tr>
				 @endforeach
			
		@endif
           
    </table>
            </div>
        </div>
    </div>
</div>
@endsection


