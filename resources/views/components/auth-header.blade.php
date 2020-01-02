{{-- Header Auth --}}
<div class="header bg-gradient-primary py-4 py-lg-4">
    <div class="container">
        <div class="header-body text-center mb-7">
            <a href="{{ route('login') }}" rel="noopener noreferrer">
                <img
                    class="img-fluid mb-4"
                    src="{{ asset('assets/images/logo-laraboilerplate-white.png') }}"
                    alt="Laraboilerplate"
                    title="Laraboilerplate"
                >
            </a>
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-6 mb-4">
                    <h1 class="text-white">
                        {{ $title }}
                    </h1>
                    <p class="text-lead text-light">
                        {{ $content }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
