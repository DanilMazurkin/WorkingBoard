@extends('layouts.app')

@section('content')

<div class="container">



	  	@if ($errors->any())
			  <div class="alert alert-danger">
			     <ul>
			        @foreach ($errors->all() as $error)
			           <li>{{ $error }}</li>
			        @endforeach
			     </ul>
			     @if ($errors->has('email'))
			     @endif
			  </div>
		@endif
   		
   		@if ($fio == 0)
   			<div class="row">
   				<div class="col-md-4">	
   					{{ __('Установите ваши ФИО') }}
   				</div>
   			</div>
   		@else 
   			{{ $fio['surname'] }} {{ $fio['name'] }}  {{ $fio['patronymic'] }}
   		@endif	

   		@if (isset($hasGoogle)) 
   			<div class="row">
   				<div class="col-md-4">
   					{{ __('Пользователь авторизирован через Google') }}
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

					    <div class="card">   

					    	<div class="card-header">
					    		Загрузить аватар
							</div>


					    	<div class="card-body">	
					        	 <form method="POST" enctype="multipart/form-data" action="{{ route('profile_update') }}">
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
				       	</div>
				        
				        <div class="card mt-2">

				        	<div class="card-header">
				        		Установить ФИО
				        	</div>


				        	<div class="card-body">
					        	<form method="POST" action="{{ route('profile_fio', ['id' => Auth::user()->id]) }}">
					        		@csrf
							        	<div class="row mt-2">
									    	<div class="col-md-8">
									    		<div class="input-group input-group-sm mb-3">
												  <input name="surname" type="text" class="form-control" placeholder="Фамилия" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
												</div>
									    	</div>
									    </div>

									    <div class="row mt-2">
									    	<div class="col-md-8">
									    		<div class="input-group input-group-sm mb-3">
												  <input name="name" type="text" class="form-control" placeholder="Имя" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
												</div>
									    	</div>
									    </div>

									    <div class="row mt-2">
									    	<div class="col-md-8">
									    		<div class="input-group input-group-sm mb-3">
												  <input name="patronymic" nametype="text" class="form-control" placeholder="Отчество" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
												</div>
									    	</div>
									    </div>


									    <div class="row mt-2">
									    	<div class="col-md-4">
									    		<button type="submit" class="btn btn-primary"> Установить </button>
									    	</div>
									    </div>
								</form>
							</div>	
						</div>

			        </div>
			    @endif

			  
		    </div>
        @endif
     

</div>

@endsection
