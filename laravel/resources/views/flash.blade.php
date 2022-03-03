<div id="flash">
    @if ($message = Session::get('success'))
    @include('flash-message', ['type' => "success", 'message' => $message])
    @endif
    
    @if ($message = Session::get('error'))
    @include('flash-message', ['type' => "error", 'message' => $message])
    @endif
    
    @if ($message = Session::get('warning'))
    @include('flash-message', ['type' => "warning", 'message' => $message])
    @endif
    
    @if ($message = Session::get('info'))
    @include('flash-message', ['type' => "info", 'message' => $message])
    @endif
    
    @if ($errors->any())
    @include('flash-message', ['type' => "error", 'message' => "Check errors!"])
    @endif
</div>