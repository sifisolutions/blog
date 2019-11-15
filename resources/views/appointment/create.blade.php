@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                          <div class="card-header">Create Appointment</div>
                          
                          
                        @include('appointment._form',['route' => 'appointment.store'])
                        
                    </div>
                </div>
            </div>
        </div>
   


@endsection