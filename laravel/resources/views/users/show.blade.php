@extends('layouts.app')
@section('content')

@include('flash-message')

<div class="card w-25 mx-auto" style="width: 18rem;">

    <div class="card-header">
        <a href="{{ route('users.index') }}" class="float-end link-secondary" role="button"> 🡰 Torna al llistat</a>
    </div>
    <h5 class="mt-3 card-title text-center "><strong>Perfil de l'usuari</strong><hr></h5>
    
    <div class="card-body">

        <div class="w-50 float-start">
            <p class="card-text"><strong>Id:</strong> {{$user->id}}</p>
            <p class="card-text"><strong>Username:</strong> {{$user->name}}</p>
            <p class="card-text"><strong>Email:</strong> {{$user->email}}</p>
            <p class="card-text"><strong>Data Creació:</strong> {{$user->created_at}}</p>
        </div>

        <div class="w-50 float-end">
            <img class="float-end w-75" src="{{ asset("storage/{$file->filepath}") }}" title="Image preview"/>
        </div>

    </div>

    <ul class="list-group list-group-flush">
        <li class="list-group-item">
            <a href="{{ route('users.edit', $user->id) }}" class="w-100 btn btn-warning" role="button">Editar</a>
        </li>

        <li class="list-group-item">
            <form method="post" action="{{ route('users.destroy', $user->id) }}">
                @csrf
                @method("DELETE")
                <button class="w-100 btn btn-danger" type="submit" onClick="document.getElementById('spin').style.display='inline-block'">
                    <div id="spin" style="display: none;" class="spinner-border spinner-border-sm" role="status"></div>
                    Esborrar
                </button>
            </form>
        </li>
    </ul>

  </div>
</div>

@endsection