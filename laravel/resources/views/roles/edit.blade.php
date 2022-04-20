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
					{{ __('Role') }}
					<a href="{{ route('roles.show', $role) }}" class="float-end link-secondary" role="button"> 🡰 Torna Enrere</a>
				</div>

				<form method="POST" action="{{ route('roles.update', $role->id) }}" class="p-3" enctype="multipart/form-data">
					@csrf
					@method("PUT")

					<div class="mb-3">
						<label class="form-label">Nom<span class="text-danger">*</span></label>
						<input name="name" type="text" value='{{ $role->name }}' class="form-control">
					</div>
					<br>

					<button class="btn btn-primary" type="submit" onClick="document.getElementById('spin').style.display='inline-block'">
						<div id="spin" style="display: none;" class="spinner-border spinner-border-sm" role="status"></div>
						Editar rol
					</button>

					<button type="reset" class="btn btn-secondary">Desfer canvis</button>

				</form>
			</div>
		</div>
	</div>
</div>


@endsection