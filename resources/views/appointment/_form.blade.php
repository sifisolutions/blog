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

                       {!! Form::select('office_id', App\WorkingHour::getOfficeList(), $model->office_id, ['class' => 'form-control']  ) !!}
               </div>
            </div>   
               
             
            <input type="hidden" id ="is_save" name="is_save" value="">
            <div class="form-group col-md-6">
                	{!! Form::label('date', 'Date', array('class' => 'control-label')) !!}	
                	{!! Form::text('date', $model->date, ['class' => 'form-control datetimepicker']  ) !!}
                	
                	 <div class ="error_date"></div>
                </div>
                
                <div class="form-group col-md-6">
                	{!! Form::label('time', 'Time', array('class' => 'control-label')) !!}	
                	{!! Form::select('time',[], $model->time, ['class' => 'form-control']  ) !!}
                </div>
                
                  <div class="form-group col-md-6">  Stretcher
                <div class ="append_html"></div>
                 </div>

                       
 </div> 
 
 <div class="form-actions">
        <button type="submit" class="btn btn-success"> Save</button>
    </div>
                 
    <script>
var optionValue = '{{$model->time}}';
var id = '{{$model->id}}';

var office_id = $("#office_id").val();
var date = $("#date").val();
if(date=='')
{
	date= 0;
}
if(optionValue=='')
{
	optionValue=0;
}

if(id=='')
{
	id= 0;
}
var time = $("#time").val();

if(time==''||time==null)
{
	time= 0;
}

$(document).ready(function() {
//showStretcher(office_id,date,time);
if(showTime(date))
{

	setTimeout(function () {
		$("#time").val(optionValue);
		time = optionValue;
		showStretcher(office_id,date,time);
		}, 500);
	

	
	
}
});



    $(document).on("change", "#office_id", function() {
    	$("#time").empty();
    	office_id = $(this).val();
    	showStretcher(office_id,date,time);
    	showTime(date);
    });

    function showStretcher(office_id,date,time)
    {
    	var url = baseUrl + '/appointment/show-stretcher/'+office_id+'/'+date+'/'+time+'/'+id;
    	$('.append_html').html('');
    	$.ajax({
    		url : url,
    		type : 'get',
    		success : function(response) {

    			if (response.status == 'OK') {
    			var is_save =$('#is_save').val();
    			if( is_save==1){
    				$('.append_html').html(response.html);
    			}else{
    				$('.append_html').html('');
    			}
    				if(  $('input:radio[id^="check_"]:checked').attr('disabled')) {
    					 $('input:radio[id^="check_"]:checked').attr('disabled',false)
    				}
    			}
    		}
    	});
    	
    }

    $(document).on("change", ".datetimepicker", function() {
    	$('.error_date').html('');
    	$('#is_save').val(' ');
        var date = $(this).val();
      showTime(date)
   });


    $(document).on("click", "[id^=check_]", function() {
        var check = $(this).val();
        var saved_check =$("#saved_check").val();
        $("#saved_check").val(check);
        

        if($('#select_check_'+saved_check).hasClass('selected-red'))
        {
        	
        	$('#select_check_'+saved_check).removeClass('selected-red');
        	$('#select_check_'+saved_check).addClass('selected-green');
        }
        
        if($('#select_check_'+check).hasClass('selected-red'))
        {
        	$('#select_check_'+check).removeClass('selected-red');
        	$('#select_check_'+check).addClass('selected-green');
        }
        else if($('#select_check_'+check).hasClass('selected-green')){
          
        	$('#select_check_'+check).addClass('selected-red');
        	$('#select_check_'+check).removeClass('selected-green');
        }
    });

    function showTime(date)
    {
        if(date!=0)
        {
    	 var url = baseUrl + '/appointment/check-date/'+office_id + '/' + date;


    	 	$.ajax({
    	 		url : url,
    	 		type : 'get',
    	 		success : function(response) {
    	 			if (response.status == 'OK') {
    	 				$('#is_save').val(1);
    	 				var html = "";
    	 				 $.each(response.time, function(key, value) {
    	 	                html += '<option value = ' + key + '>' + value + '</option>';
    	 	            });
    	 				$("#time").empty();
    					$("#time").html(html);
    	                var time = $('#time').val();
    					showStretcher(office_id,date,time);
    		            
    	 			}else {
    	 				$('#is_save').val(' ');
    	 				$("#time").empty();
    	 				$('.append_html').html('');
    	 				$('.error_date').html(response.error);	
    	 			}
    	 		}
    	 	});
        }
        return true;
    }


    $(document).on("change", "#time", function() {
    	  var date = $('.datetimepicker').val();
    	  var time = $(this).val();
    	  showStretcher(office_id,date,time);
   });
    
    $('.datetimepicker').flatpickr({
	    enableTime: false,
	    dateFormat: "Y-m-d",
	    minDate: "today",
	});
    		
			
		</script>
  
               {!! Form::close() !!}