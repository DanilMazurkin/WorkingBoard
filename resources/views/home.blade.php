@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="row justify-content-center">
        <div class="col-md-12 block-info">
            <p class="block-text pl-5 pt-5"> Пользователи </p>
        </div>
    </div>


    <div class="row justify-content-center mt-2">
        
        <div class="col-md-6">
            <a class="btn btn-block menu-button" href="#">
                 <strong href="{{ route('create_ad_form') }}"> Создать объявление </strong>
            </a>
        </div>

        <div class="col-md-6">
            <a class="btn btn-block menu-button" href="#">
                 <strong> Новые объявления </strong>
            </a>
        </div>

    </div>

    <div class="row justify-content-center mt-2 ml-2">
        @foreach ($users as $user)
               <div class="card ml-3" style="width: 18rem;">
                   @if ($user->checkUserFromGoogle($user->id))
                                            <img class="img-thumbnail rounded float-left" src="{{ $userdata->getPathAvatarUser($user->id)                            
                                            }}" alt="Card image cap">  
                    @else
                                            <img class="img-thumbnail rounded float-left" src="{{ asset('storage/'.$userdata->getPathAvatarUser($user->id)) }}">
                    @endif
                  
                  <div class="card-body">
                    <h5 class="card-title">{{ $user->name  }}</h5>
                    <p class="card-text">
                        @if ($fio !=  0)
                            {{ $user->userdata->surname }} 
                            {{ $user->userdata->name }} 
                            {{ $user->userdata->patronymic }}
                        @endif

                    </p>

                    <form method="GET" action="{{ route('view_ads', $user->id) }}">
                                        <input type="hidden" value="{{ $user->id  }}"/> 
                                        <button class="btn  ad-button"> Просмотреть объявления </button>
                    </form>
                  </div>
                </div>

        @endforeach
    </div>

    <div class="row mt-2 justify-content-center">
        {{ $users->links() }}
    </div>



</div>
@endsection


@push('styles')
    <link href="{{ asset('home.css') }}" rel="stylesheet">
@endpush