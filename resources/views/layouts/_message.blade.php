@foreach (['danger', 'warning', 'success', 'info'] as $msg)
@if(session()->has($msg))
<div class="flash-message alert-dismissible">

    <p class="alert alert-{{ $msg }} alert-dismissible">
        {{ session()->get($msg) }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </p>
</div>
@endif
@endforeach
