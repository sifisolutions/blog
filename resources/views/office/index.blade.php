@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class ="btn_right" ><a href="{{ route('office.create') }}" class="btn btn-success">Create Office </a></div>
                
                 

               
               <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>No of Stretcher</th>
                <th>Action</th>
                
            </tr>
        </thead>
        <tbody>
            
            
            
              @if ($models)
		
				@foreach ($models as $model)
				<tr>
				<td>{{ $model->name }} </td>
				
				 <td>{{ $model->no_of_stretcher }} </td>
				 <td>  <a href="{{ route('office.edit', ['id' => $model->id]) }}" data-toggle="tooltip" data-original-title="Edit"> 
                    	Edit
                    </a>
                    <a href="{{ route('office.destroy',['id' => $model->id]) }}" data-toggle="tooltip" data-original-title="Delete"> 
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


