@extends('layouts.app')

@section('content')
@include('flash-message')

<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">{{ __('Files') }}</div>
               <div class="card-body">
                   <table class="table">
                       <thead>
                           <tr>
                               <td scope="col">ID</td>
                               <td scope="col">name</td>
                               <td scope="col">phone</td>
                               <td scope="col">email</td>
                               <td scope="col">logo</td>
                               <td scope="col">Created</td>
                               <td scope="col">Updated</td>
                           </tr>
                       </thead>
                       <tbody>
                           @foreach ($files as $file)
                           <tr>
                               <td>{{ $file->id }}</td>
                               <td>{{ $file->name }}</td>
                               <td>{{ $file->phone }}</td>
                               <td>{{ $file->email }}</td>
                               <td>{{ $file->logo_id }}</td>
                               <td>{{ $file->created_at }}</td>
                               <td>{{ $file->updated_at }}</td>
                           </tr>
                           @endforeach
                       </tbody>
                   </table>
                   <a class="btn btn-primary" href="{{ route('files.create') }}" role="button">Add new file</a>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection