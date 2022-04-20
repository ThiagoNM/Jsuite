@extends('layouts.app')

@section('content')
@include('flash-message')

<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					{{ __('Users') }}
					<a href="{{ route('security.index') }}" class="float-end link-secondary" role="button"> 🡰 Torna al menú</a>
				</div>
				<div class="card-body">
					<table class="table">
						<thead>
							<tr>
								<td scope="col">ID</td>
								<td scope="col">Name</td>
								<td scope="col">Email</td>
							</tr>
						</thead>
						<tbody>
							@foreach ($users as $user)
							<tr>
								<td>{{ $user->id }}</td>
								<td>{{ $user->name }}</td>
								<td>{{ $user->email }}</td>
								<td><a href="{{ route('users.show', $user->id) }}" class="w-100 btn btn-secondary" role="button">⚙︎ Gestionar</a></td>
							</tr>
							@endforeach
						</tbody>
					</table>
					<a class="btn btn-primary" href="{{ route('users.create') }}" role="button">+ Afegir nou usuari</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection