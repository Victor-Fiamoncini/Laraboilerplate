{{-- Flash Messages --}}
@if (session('status') && session('message'))
    <div
        class="alert alert-{{ session('status') }} alert-dismissible fade show"
        role="alert"
    >
        <span class="alert-inner--text">
            <strong>{{ session('message') }}</strong>
        </span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
