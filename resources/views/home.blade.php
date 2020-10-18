@extends('layouts.app')

@section('content')
<div class="container">
    
    @if (empty($userdata->name))
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

                    <img class="img-thumbnail" src="{{ asset($userdata->getPathAvatarUser($user->id)) }}" alt="Card image cap">  
        
                  </div>

                <div class="card-footer text-muted">
                    <button class="btn btn-warning"> Начать отслеживать </button>
                    <button class="btn btn-primary"> Просмотреть объявления </button>
                </div>
            </div>
        </div>
    @endforeach

    <div class="row mt-2 justify-content-center">
        {{ $users->links() }}
    </div>



</div>
@endsection
