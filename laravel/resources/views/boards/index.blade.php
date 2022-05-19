@extends('layouts.app')

@section('content')
@include('flash-message')

<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">{{ __('Models') }}</div>
               <div class="card-body">
                   <table class="table">
                       <thead>
                           <tr>
                                <td scope="col">id</td>
                                <td scope="col">Manufacturer</td>
                                <td scope="col">Model</td>
                                <td scope="col">Price</td>
                                <td scope="col">Category_id</td>
                                <td scope="col">Photo_id</td>
                           </tr>
                       </thead>
                       <tbody>
                           @foreach ($models as $model)
                           <tr>
                                <td>{{ $model->id }}</td>
                                <td>{{ $model->manufacturer }}</td>
                                <td>{{ $model->model }}</td>
                                <td>{{ $model->price }}</td>
                                <td>{{ $model->category_id }}</td>
                                <td>{{ $model->photo_id }}</td>
                           </tr>
                           @endforeach
                       </tbody>
                   </table>
                   <a class="btn btn-primary" href="{{ route('modelos.create') }}" role="button">Afegeix model</a>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection