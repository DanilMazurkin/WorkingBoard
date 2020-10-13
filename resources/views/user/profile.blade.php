@extends('layouts.app')

@section('content')

<div class="container">

	  	@if ($errors->first('avatar')) 
	        <div class="row justify-content-center">
	            <div class="col-md-12">
	                <div class="alert alert-danger" role="alert">
	                    {{ $errors->first('avatar') }}
	                </div>
	            </div>
	        </div>
   		 @endif

		@if (isset($pathAvatar))
			<div class="row mt-2">
		        <div class="col-md-4">
		        		 <img class="img-thumbnail" src= "{{ asset($pathAvatar) }}" alt="Card image cap">  
		        </div>

		        @if (Auth::user()->id == $id)
			        <div class="col-md-8">
			        	 <form method="POST" enctype="multipart/form-data">
			        	 	  @csrf     
			        	 	  {{ method_field('PATCH') }}                             
							  <div class="custom-file">
							    <input type="file" name="avatar" class="custom-file-input" id="validatedCustomFile" required>
							    <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
							    <div class="invalid-feedback">Example invalid custom file feedback</div>
							  </div>

			        	 	  	<button class="btn col-md-12 btn-primary mt-1"> Установить новый аватар </button>
			        	 </form>
			        </div>
			    @endif
		    </div>
        @endif




</div>

@endsection
