@extends('layouts.app')

@section('content')
<div class="container">
    
    @if (empty($ame))
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="alert alert-danger">
                            Установите ФИО в профиле!
                        </div>
                    </div>
                </div>
    @endif

    @foreach ($users as $user)
        <div class="row justify-content-center mt-2">
            <div class="card col-md-6">
                  
                  <div class="card-header">
                    ID:    {{ $user->id }}
                    Login: {{ $user->name }}
                  </div>
                 
                  <div class="card-body">
                    <h5 class="card-title">
                        @if ($fio !=  0)
                            {{ $user->userdata->surname }} 
                            {{ $user->userdata->name }} 
                            {{ $user->userdata->patronymic }}
                        @else
                            {{ __('У пользователя не установлен ФИО') }}
                        @endif
                    </h5>

                        @if ($user->checkUserFromGoogle($user->id))

                            <img class="img-thumbnail" src="{{ $userdata->getPathAvatarUser($user->id)                            
                            }}" alt="Card image cap">  
                        @else
                            <img class="img-thumbnail" src="{{ asset('storage/'.$userdata->getPathAvatarUser($user->id)) }}">
                        @endif
        
                  </div>

                <div class="card-footer text-muted">
                    <button class="btn btn-warning"> Начать отслеживать </button>

                    <form method="GET" action="{{ route('view_ads', $user->id) }}">
                        <input type="hidden" value="{{ $user->id  }}"/> 
                        <button class="btn btn-primary"> Просмотреть объявления </button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    <div class="row mt-2 justify-content-center">
        {{ $users->links() }}
    </div>



</div>
@endsection
