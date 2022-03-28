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

  <form method="post" action="{{ route('files.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="upload">File:</label>
        <input type="file" class="form-control" name="upload"/>
    </div>
    <button type="submit" class="btn btn-primary">Create</button>
    <button type="reset" class="btn btn-secondary">Reset</button>
  </form>

@endsection