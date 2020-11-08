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
   		

		<form method="POST" enctype="multipart/form-data">
			@csrf

			<div class="row">					
					<div class="col-md-6 mb-3">
				      <input type="text" name="header" class="form-control" id="validationTooltip01" placeholder="Заголовок объявления" required>
				    </div>
			</div>

			<div class="row">
				  <div class="form-group col-md-6">
				    <textarea class="form-control" name="text" id="exampleFormControlTextarea1" placeholder="Текст объявления"rows="3" required></textarea>
				  </div>
			</div>

			<div class="row">
				<div class="input-group mb-3 col-md-6">
				  <div class="input-group-prepend">
				    <span class="input-group-text"> Загрузка </span>
				  </div>
				  <div class="custom-file">
				    <input type="file" class="custom-file-input" name="image" id="inputGroupFile01">
				    <label class="custom-file-label" for="inputGroupFile01">Изображение объявления</label>
				  </div>
				</div>
			</div>

			<button class="btn btn-primary" type="submit"> Создать </button>
		
		</form>
	</div>

@endsection
