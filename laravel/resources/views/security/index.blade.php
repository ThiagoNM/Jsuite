@extends('layouts.app')

@section('content')
@include('flash-message')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Security') }}</div>
                <div class="card-body">
                    <div class="p-2">
                        <h5>Usuaris</h5>
                        <a class="btn btn-primary" href="{{ route('users.index') }}" role="button">Administrar usuaris</a>
                    </div>
                    <hr>
                    <div class="p-2">
                        <h5>Rols</h5>
                        <a class="btn btn-primary" href="{{ route('roles.index') }}" role="button">Administrar rols</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection