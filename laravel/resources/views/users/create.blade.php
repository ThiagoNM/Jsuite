@extends('layouts.app')
@section('content')
@include('flash-message')


@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Crear Usuari') }}
                    <a href="{{ route('users.index') }}" class="float-end link-secondary" role="button"> 🡰 Torna Enrere</a>
                </div>
                <div class="card-body">
                    <form class="mx-auto" method="post" action="{{ route('users.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Adreça de correu<span class="text-danger">*</span></label>
                            <input name="email" type="email" class=" mw-10 form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nom<span class="text-danger">*</span></label>
                            <input name="name" type="text" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Contrasenya<span class="text-danger">*</span></label>
                            <input name="password" type="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="upload">Foto del perfil<span class="text-danger">*</span></label>
                            <input name="upload" type="file" class="form-control" name="upload" />
                        </div>
                        <br>

                        <label for="cars">Escollir rol: </label>
                        <div class="form-group">
                            <select class="w-25" name="role_id" id="role_id">

                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach

                            </select> 
                        </div>
                        <br>

                        <button class="btn btn-primary w-25" type="submit" onClick="document.getElementById('spin').style.display='inline-block'">
                            <div id="spin" style="display: none;" class="spinner-border spinner-border-sm" role="status"></div>
                            Crear usuari
                        </button>

                        <button type="reset" class="btn btn-secondary w-25">Resetejar formulari</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>



@endsection