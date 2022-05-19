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
            {{ __('Model') }}
            <div class="mb-3">
                <span>Nom de la categoria: {{$category->name}}</span>
                <span>id: {{$model->id}}</span>
            </div>
            <div>
                <span>Model: {{$modelo->model}}</span><br>
                <span>Manufacturer: {{$modelo->manufacturer}}</span><br>
                <span>Preu: {{$modelo->price}}</span><br>
                <span>Photo: {{$modelo->model}}</span><img src="{{ asset('storage/{$file->filepath}') }}" /><br>
                <span>Categoria: {{$category->name}}</span><br>
            </div>
            <div class="mb-3">
                <button href="{{ route('models.edit',$model) }}" role="button">Edit category</button>
            </div>
            <form method="post" action="{{ route('models.destroy',$model) }}" enctype="multipart/form-data" >
                    @csrf
                    @method('DELETE')
                <div class="mb-3">
                    <button type="submit">Esborra</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection