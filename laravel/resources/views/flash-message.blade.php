@if ($message = Session::get('success'))
   <div class="alert alert-success alert-dismissible">
      <p class="text-center"><strong>{{ $message }}</strong></p>
   </div>
@endif

 @if ($message = Session::get('error'))
<div class="alert alert-danger alert-block">
   <p class="text-center"><strong>{{ $message }}</strong></p>
</div>
@endif

<!-- 

@if ($message = Session::get('warning'))
<div class="alert alert-warning alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>    
    <strong>{{ $message }}</strong>
</div>
@endif

@if ($message = Session::get('info'))
<div class="alert alert-info alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>    
    <strong>{{ $message }}</strong>
</div>

@if ($errors->any())
<div class="alert alert-danger">
   <p class="text-center"><strong>Ocurrió un error!</strong></p>
</div>
@endif 

@endif -->
  
