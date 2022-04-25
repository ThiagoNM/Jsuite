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

  <form method="post" action="{{ route('companies.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="form-group w-25 mx-auto">
        <label>Name</label>
        <input type="text" class="form-control" name="name"></input><br>
        <label>Phone</label>
        <input type="text" class="form-control" name="phone"></input><br>
        <label>email</label>
        <input type="text" class="form-control" name="email"></input><br>
        <label for="logo">Logo:</label>
        <input type="file" class="form-control" name="logo"/>
    </div>
        <button type="submit" class="btn btn-outline-success ">Create</button>
        <button type="reset" class="btn btn-outline-warning ">Reset</button>
  </form>

@endsection