{{-- Message --}}
<div class="alert alert-{{ $status }} alert-dismissible fade show" role="alert">
    <span class="alert-inner--text {{ $heading }} text-white">
        <strong>{{ $message }}</strong>
    </span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
