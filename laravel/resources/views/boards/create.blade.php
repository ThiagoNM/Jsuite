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
            {{ __('Crear Model') }}
            <form method="post" action="{{ route('models.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <span>Manufacturer: </span><input name="manufacturer" type="text"/>
                </div>
                <div class="mb-3">
                    <span>Model: </span><input name="model" type="text"/>
                </div>
                <div class="mb-3">
                    <span>Preu: </span><input name="price" type="text"/>
                </div>
                <div class="mb-3">
                    <span>Selecciona una categoría: </span>
                    <select name="category_id" value>
                        @foreach($categories as $category)
                        <option value={{$category->id}}>
                            {{$category->name}}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <span>Photo_id: </span><input type="file" name="photo"/>
                </div>
                <button type="submit" >Envia</button>
            </form>
        </div>
    </div>
</div>

@endsection