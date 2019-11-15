@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class ="btn_right" ><a href="{{ route('working-hour.create') }}" class="btn btn-success">Create Working Hour </a></div>
                
                 

               
               <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Office</th>
                <th>Days</th>
                <th>Type</th>
                <th>Time</th>
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
				<td> {{$model->getDays()}} </td>
				
				
				 <td>  {{$model->getType($model->type_id)}}</td>
				 <td>  {{$model->getTime()}}</td>
				 <td>  <a href="{{ route('working-hour.edit', ['id' => $model->id]) }}" data-toggle="tooltip" data-original-title="Edit"> 
                    	Edit
                    </a>
                    <a href="{{ route('working-hour.destroy',['id' => $model->id]) }}" data-toggle="tooltip" data-original-title="Delete"> 
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


