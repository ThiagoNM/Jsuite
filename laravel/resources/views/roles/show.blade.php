@extends('layouts.app')
@section('content')

@include('flash-message')

<div class="card w-25 mx-auto" style="width: 18rem;">

    <div class="card-header">
        <a href="{{ route('roles.index') }}" class="float-end link-secondary" role="button"> 🡰 Torna al llistat</a>
    </div>

    <div class="card-body">
        <h5 class="card-title text-center   "><strong>Informació sobre el rol</strong></h5>

        <p class="card-text"><strong>Id:</strong> {{$role->id}}</p>
        <p class="card-text"><strong>Name:</strong> {{$role->name}}</p>
        
        <ul class="list-group list-group-flush">
            <li class="list-group-item">
                <a href="{{ route('roles.edit', $role->id) }}" class="w-100 btn btn-warning" role="button">Editar</a>
            </li>

            <li class="list-group-item">
                <form method="post" action="{{ route('roles.destroy', $role->id) }}">
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