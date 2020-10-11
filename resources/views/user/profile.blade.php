@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">

        @if (isset($pathAvatar))
	        <div class="col-md-4">
	        		 <img class="img-thumbnail" src= "{{ asset($pathAvatar) }}" alt="Card image cap">  
				
				@if (Auth::user()->id == $id)
					 <form method="POST" enctype="multipart/form-data">
                          @csrf
                            <div class="row">
                              <div class="col-md-12">
                                  
                                      <div class="custom-file">
                                        
                                        <input type="file" name="avatar" class="custom-file-input" id="customFile">

                                        <label class="custom-file-label" for="customFile">Загрузить аватар</label>
                                          <button class="btn  btn-primary">  Загрузить </button>
                                      </div>
                                
                              </div>
                            </div>
                    </form>
			   	@endif

	        </div>
        @endif
    </div>


</div>
</div>

@endsection
