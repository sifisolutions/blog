@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                          <div class="card-header">Update Working Hour</div>
                          
                        @include('appointment._form',['route' => ['appointment.update','id' => $model->id]])
                        
                    </div>
                </div>
            </div>
        </div>
   


@endsection