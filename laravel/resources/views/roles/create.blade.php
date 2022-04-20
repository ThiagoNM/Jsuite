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
                    {{ __('Crear Rol') }}
                    <a href="{{ route('roles.index') }}" class="float-end link-secondary" role="button"> 🡰 Torna Enrere</a>
                </div>
                <div class="card-body">
                    <form class="mx-auto" method="post" action="{{ route('roles.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nom<span class="text-danger">*</span></label>
                            <input name="name" type="text" class="form-control">
                        </div>

                        <button class="btn btn-primary w-25" type="submit" onClick="document.getElementById('spin').style.display='inline-block'">
                            <div id="spin" style="display: none;" class="spinner-border spinner-border-sm" role="status"></div>
                            Crear rol
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