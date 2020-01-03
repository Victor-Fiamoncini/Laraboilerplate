{{-- Modal --}}
<div
    class="modal fade"
    id="{{ $name }}"
    tabindex="-1"
    role="dialog"
    aria-labelledby="modal"
    aria-hidden="true"
>
    <div class="modal-dialog modal-danger modal-dialog-centered modal-10" role="document">
        <div class="modal-content bg-{{ $background }}">
            <div class="modal-header">
                <h4 class="modal-title">{{ $title }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">{{ $content }}</div>
        </div>
    </div>
</div>
