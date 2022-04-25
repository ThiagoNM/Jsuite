@extends('layouts.app')

@section('content')
@include('flash-message')

<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">{{ __('Companies') }}</div>
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
                           @foreach ($companies as $Company)
                           <tr>
                               <td>{{ $Company->id }}</td>
                               <td>{{ $Company->name }}</td>
                               <td>{{ $Company->phone }}</td>
                               <td>{{ $Company->email }}</td>
                               <td>{{ $Company->logo_id }}</td>
                               <td>{{ $Company->created_at }}</td>
                               <td>{{ $Company->updated_at }}</td>
                           </tr>
                           @endforeach
                       </tbody>
                   </table>
                   <a class="btn btn-primary" href="{{ route('companies.create') }}" role="button">Add Ticket</a>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection