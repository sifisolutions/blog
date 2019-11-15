@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                          <div class="card-header">Update Working Hour</div>
                          
                        @include('working-hour._form',['route' => ['working-hour.update','id' => $model->id]])
                        
                    </div>
                </div>
            </div>
        </div>
   


@endsection