@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Calender</div>
                 <div id ="calendar"></div>
          </div>
          </div>
          </div>
          </div>      
                 
                   <script src="{{ asset('js/moment.min.js')}}"></script>
                     <script src="{{ asset('js/fullcalendar.min.js')}}"></script>
  <link rel="stylesheet" href="{{ asset('css/fullcalendar.css')}}" />

  <script>

  @php 
  $dataArray = json_encode($events);
  @endphp

  $(document).ready(function() {
	  var data = $.parseJSON('<?=$dataArray?>');
    var calendar = $('#calendar').fullCalendar({
    editable:true,
    header:{
     left:'prev,next today',
     center:'title',
     right:'month,agendaWeek,agendaDay'
    },
    events: data,
  

   

  

   });
  });
   
  </script>
  
  @endsection