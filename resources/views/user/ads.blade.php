@extends('layouts.app')

@section('content')
	 
   <div class="container">
    
      @if (count($ads) == 0)
          <div class="row justify-content-center mt-2">
              <div class="col-md-12">
                {{ __('У полльзователя нет объявлений') }}
              </div>
          </div>
      @endif


    	@foreach ($ads as $ad)
    		<div class="row justify-content-center mt-2">
                <div class="card col-md-6">
                      
                      <div class="card-header">
                        Header: {{ $ad->name }}
                      </div>
                     
                      <div class="card-body">
                        <h5 class="card-title">
                           {{ $ad->text }}
                        </h5>
                        
                        <img class="img-thumbnail" src="{{ asset('storage/'.$ad->image) }}">
                           
            
                      </div>

                </div>
            </div>	
    	@endforeach
    </div>
	

@endsection