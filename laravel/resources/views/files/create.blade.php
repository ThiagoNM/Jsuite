@extends('layouts.app')

@section('content')

<form role="form" method="POST" action="{{ route('files.store') }}" enctype="multipart/form-data">

  @csrf  
  @include('flash-message')
  <div class="form-group d-flex justify-content-center">
      <input type="file" class="form-control-file" name="file">
  <br>
  <button type="submit" class="btn btn-primary">Guardar</button>
  </div>
  
</form>

@endsection