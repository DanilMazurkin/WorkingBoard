@extends('layouts.app')

@section('content')

	<div class="container">

		<div class="row">
			<div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
			  <div class="card-header">Контактные данные</div>
			  <div class="card-body">
			    <h5 class="card-title"> Свяжитесь с пользователем </h5>
			    <p class="card-text">
			    	@if (isset($phone_number))
			    		{{ $phone_number }}
			    	@else 
			    		{{ __('Пользователь не указал номер телефона') }}
			    	@endif

			    	<br />
			    	{{ $email }}
			    </p>
			  </div>
			</div>
		</div>

	</div>



@endsection