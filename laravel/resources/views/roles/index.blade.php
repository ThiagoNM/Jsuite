@extends('layouts.app')

@section('content')
@include('flash-message')

<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					{{ __('Roles') }}
					<a href="{{ route('security.index') }}" class="float-end link-secondary" role="button"> 🡰 Torna al menú</a>
				</div>
				<div class="card-body">
					<table class="table">
						<thead>
							<tr>
								<td scope="col">ID</td>
								<td scope="col">Name</td>
							</tr>
						</thead>
						<tbody>
							@foreach ($roles as $role)
							<tr>
								<td>{{ $role->id }}</td>
								<td>{{ $role->name }}</td>
								<td><a href="{{ route('roles.show', $role->id) }}" class="float-end w-50 btn btn-secondary" role="button">⚙︎ Gestionar</a></td>
							</tr>
							@endforeach
						</tbody>
					</table>
					<a class="btn btn-primary" href="{{ route('roles.create') }}" role="button">+ Afegir nou rol</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection