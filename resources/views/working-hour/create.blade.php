@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                          <div class="card-header">Create Working Hour</div>
                          
                          
                         
                          
                        @include('working-hour._form',['route' => 'working-hour.store'])
                        
                    </div>
                </div>
            </div>
        </div>
   


@endsection