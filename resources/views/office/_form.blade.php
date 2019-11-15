 @if ($errors->any())
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
				<li>{{ $error }}</li> @endforeach
			</ul>
		</div>
		@endif

 
@if($create=='true')
<form method="POST" action="{{ route('office.store') }}">
@else
<form method="POST" action="{{ route('office.update', ['id' => $model->id]) }}">
@endif

                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name',$model->name) }}">

                              
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="no_of_stretcher" class="col-md-4 col-form-label text-md-right">{{ __('No Of Stretcher') }}</label>

                            <div class="col-md-6">
                                <input type="number" class="form-control @error('no_of_stretcher') is-invalid @enderror" value="{{ old('no_of_stretcher',$model->no_of_stretcher) }}" name="no_of_stretcher">

                              
                            </div>
                        </div>

                       

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                   {{ __('Submit') }}
                                </button>

                             
                            </div>
                        </div>
                    </form>