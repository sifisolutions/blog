 @if ($errors->any())
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
				<li>{{ $error }}</li> @endforeach
			</ul>
		</div>
		@endif

 
{!! Form::model($model,['route' => $route, 'class' => 'form-horizontal form-material enableAjaxValidation','id' => 'working-form', 'method' => 'POST']) !!}

                        @csrf
                          
                          
                          
                     <div class="row">
            <div class="col-md-6">
                <div class="form-group">  
                       {!! Form::label('office_id', 'Office', array('class' => 'control-label')) !!}	</label>

                       {!! Form::select('office_id', $model->getOfficeList(), $model->office_id, ['class' => 'form-control']  ) !!}
               </div>
            </div>   
               
               <div class="col-md-6">
                <div class="form-group">  
        <p class="w-100 m-0">Days</p>
       
        @foreach($model->getDaysList() as $index => $val)
            <div class="genre-checkbox-content">
                <input name="days[]" class="form-check-input genre-checkbox" type="checkbox"
                       id="days{{$index}}" value="{{$index }}"
                       {{ App\WorkingHour::checkedArray('days', $index ,$model->days) }}>
                <label class="form-check-label" for="days{{$index}}">
                    {{ $val }}
                </label>
            </div>
        @endforeach
    </div>
     </div>
    
       <div class="col-md-12">
                <div class="form-group">  
                       {!! Form::label('type_id', 'Type', array('class' => 'control-label')) !!}	</label>

                       {!! Form::select('type_id', $model->getType(), $model->type_id, ['class' => 'form-control']  ) !!}
               </div>
            </div>
            
            
            <div class="form-group col-md-6">
                	{!! Form::label('start_time', 'Start Time', array('class' => 'control-label')) !!}	
                	{!! Form::text('start_time', $model->start_time, ['class' => 'form-control datetimepicker']  ) !!}
                </div>
                <div class="form-group col-md-6">
                	{!! Form::label('finish_time', 'End Time', array('class' => 'control-label')) !!}	
                	{!! Form::text('finish_time', $model->finish_time, ['class' => 'form-control datetimepicker']  ) !!}
                </div>
                <div class="col-md-12">
                <div class ="dis-time">
                <div class="row">
                 <div class="form-group col-md-6">
                	{!! Form::label('start_time1', 'Start Time', array('class' => 'control-label')) !!}	
                	{!! Form::text('start_time1', $model->start_time1, ['class' => 'form-control datetimepicker']  ) !!}
                </div>
                <div class="form-group col-md-6">
                	{!! Form::label('finish_time1', 'End Time', array('class' => 'control-label')) !!}	
                	{!! Form::text('finish_time1', $model->finish_time1, ['class' => 'form-control datetimepicker']  ) !!}
                </div>
                </div> 
                </div>  </div>  

                       
 </div> 
 
 <div class="form-actions">
        <button type="submit" class="btn btn-success"> Save</button>
    </div>
                 
    <script>

      var type_id= $('#type_id').val();

      $(document).ready(function(){
    		showhideType(type_id);
      });

      $(document).on("change","#type_id",function() {
    	  type_id= $(this).val();
    	  showhideType(type_id);

      });   

      function showhideType(type_id)
      {
  if( type_id==0)
  {
	  $(".dis-time").css("display", "none");
  }else {
	  $(".dis-time").css("display", "block");
  }
      }
    	
    		$(".datetimepicker").flatpickr({
    		    enableTime: true,
    		    noCalendar: true,
    		    dateFormat: "H:i",
    		    time_24hr: true
    		});
			
		</script>
  
               {!! Form::close() !!}