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
            <p class="card-text"><strong>Rol:</strong> {{$role->name}}</p>
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
        <form id="form" method="POST" action="{{ route('users.destroy', $user) }}">
                @csrf
                @method("DELETE")
                <button id="destroy" type="submit" class="w-100 btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmModal">Esborrar</button>
            </form>
            <!-- Modal -->
            <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Estas segur?</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Aquesta acció no es pot desfer
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel·lar</button>
                            <button id="confirm" class="btn btn-primary" type="submit" onClick="document.getElementById('spin').style.display='inline-block'">
                                <div id="spin" style="display: none;" class="spinner-border spinner-border-sm" role="status"></div>
                                Confirmar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </li>
    </ul>
  </div>
</div>


<script type="text/javascript">                
    const submit = document.getElementById('destroy')
    const  confirm = document.getElementById('confirm')

    submit.addEventListener("click", function( event ) {
        event.preventDefault()
        return false
    })

    confirm.addEventListener("click", function( event ) {
        document.getElementById("form").submit(); 
    })
</script>

@endsection