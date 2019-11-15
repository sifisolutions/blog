     @if (!empty($office))
                            <div class="">
                            <input type="hidden" name="check" id="saved_check"  value="{{isset($appointmentModel->stretcher_no)?$appointmentModel->stretcher_no:0}}">
                            @for( $i=1; $i<=$office->no_of_stretcher;$i++ )
                                 <label class="container-radio">{{$i}}
                            <input type="radio" id ="check_{{$i}}" class="stretcher_no" name="stretcher_no" value="{{$i}}" {{isset($appointmentModel->stretcher_no)?($appointmentModel->stretcher_no==$i?'checked':''):''}}
                             {{in_array($i,$appointment)?'disabled':''}} >
                               <span  id ="select_check_{{$i}}" class="checkmark {{in_array($i,$appointment)?'selected-red':'selected-green'}}">
                               {{$i}}</span>
                            </label>
                              
                               @endfor
                            </div> 
                            
                            <div class="error-message"></div>
   @endif