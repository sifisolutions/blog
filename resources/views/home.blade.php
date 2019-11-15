@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

               
               
               
               <div class="row">
                <div class="col-md-3">
                        <a class="btn btn-default" href="{{ url('/office') }}">Office</a>
                        
                      
                </div>
                <div class="col-md-3">
                        <a  class="btn btn-default" href="{{ url('/working-hour') }}">Working Hours</a>
                        
                      
                </div>
                <div class="col-md-3">
                        <a  class="btn btn-default" href="{{ url('/appointment') }}">Appointment</a>
                        
                </div>
                <div class="col-md-3">
                        <a  class="btn btn-default" href="{{ url('/calender') }}">Calender</a>
                        
                </div>
           

            
        </div>
               
               
               
            </div>
        </div>
    </div>
</div>
@endsection
