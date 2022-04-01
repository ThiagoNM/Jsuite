@extends('layouts.app')
@section('content')
  
    @include('flash-message')

    <div class="card text-center mx-auto" style="width: 18rem;">
        <img class="img-fluid" src="{{ asset("storage/{$fitxer->filepath}") }}" title="Image preview"/>
        <div class="card-body">
            <h5 class="card-title"><strong>Foto Pujada</strong></h5>
            <p class="card-text">Opcions disponibles:</p>
            <a class="btn btn-outline-warning" href="{{ route('files.edit',$fitxer->id) }}" role="button">Editar</a>
            <a href="#" class="btn btn-outline-danger">Esborrar</a>
        </div>
    </div>

@endsection
