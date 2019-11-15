@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                          <div class="card-header">Update Office</div>
                          
                        @include('office._form',['create' =>'false' ,'model'=>$model])
                        
                    </div>
                </div>
            </div>
        </div>
   


@endsection