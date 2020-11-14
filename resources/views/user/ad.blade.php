@extends('layouts.app')

@section('content')
	


	<div class="container-fluid ad-create">
			
		<div class="row justify-content-center">
              <div class="col-md-12 block-info">
                  <p class="block-text pl-5 pt-5"> {{ __('Вы можете создать объявление') }} </p>
              </div>
        </div>



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
   		

				<form method="POST" enctype="multipart/form-data">
					@csrf

					<div class="row mt-2">					
							<div class="col-md-12 mb-3">
						      <input type="text" name="header" class="form-control" id="validationTooltip01" placeholder="Заголовок объявления" required>
						    </div>
					</div>

					<div class="row">
						  <div class="form-group col-md-12">
						    <textarea class="form-control" name="text" id="exampleFormControlTextarea1" placeholder="Текст объявления"rows="3" required></textarea>
						  </div>
					</div>

					<div class="row">
						<div class="input-group mb-3 col-md-12">
						  <div class="input-group-prepend">
						    <span class="input-group-text"> Загрузка </span>
						  </div>
						  <div class="custom-file">
						    <input type="file" class="custom-file-input" name="image" id="inputGroupFile01">
						    <label class="custom-file-label" for="inputGroupFile01">Изображение объявления</label>
						  </div>
						</div>
					</div>

					<button class="btn btn-primary col-md-12" type="submit"> Создать </button>
				
				</form>
	</div>

@endsection

@push('styles')
  <link rel="stylesheet" href="{{ asset('ads.css') }}">
@endpush