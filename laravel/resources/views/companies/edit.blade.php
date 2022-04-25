@extends('layouts.app')

@section('content')
  
    @include('flash-message')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td scope="col">ID</td>
                                    <td scope="col">Filepath</td>
                                    <td scope="col">Filesize</td>
                                    <td scope="col">Created</td>
                                    <td scope="col">Updated</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $fitxer->id }}</td>
                                    <td>{{ $fitxer->filepath }}</td>
                                    <td>{{ $fitxer->filesize }}</td>
                                    <td>{{ $fitxer->created_at }}</td>
                                    <td>{{ $fitxer->updated_at }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

  <form method="POST" action="{{ route('companies.update', $fitxer->id) }}" enctype="multipart/form-data">
    @csrf
    @method("PUT")
    <div class="form-group">
        <label for="upload">File:</label>
        <input type="file" class="form-control" name="upload"/>
    </div>
    <button type="submit" class="btn btn-primary">Edit File</button>
  </form>

@endsection