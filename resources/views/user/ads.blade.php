@extends('layouts.app')

@section('content')
	 
   <div class="container-fluid">
    
      @if (count($ads) == 0)
          <div class="row justify-content-center">
              <div class="col-md-12 block-info">
                  <p class="block-text pl-5 pt-5"> {{ __('У пользователя нет созданных объявлений') }} </p>
              </div>
          </div>
      @else
        <div class="row justify-content-center">
              <div class="col-md-12 block-info">
                  <p class="block-text pl-5 pt-5"> {{ __('Объявления пользователя') }} </p>
              </div>
        </div>
      @endif

      <div class="row justify-content-center mt-2">

    	@foreach ($ads as $ad)
                <div class="card" style="width: 18rem;">
                    <img class="img-thumbnail" src="{{ asset('storage/'.$ad->image) }}">
                    <div class="card-body">
                      <ul class="list-group list-group-flush">
                          <li class="list-group-item"> {{ $ad->name }}</li>
                      </ul>
                      <p class="card-text pt-2">{{ $ad->text }}</p>
                      <a href="#" class="card-text pt-2"> Весь текст </a>

                    </div>
                </div>	
    	@endforeach

      </div>

      

    </div>
	

@endsection

@push('styles')
  <link rel="stylesheet" href="{{ asset('ads.css') }}">
@endpush