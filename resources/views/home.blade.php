@extends('layouts.app_modern')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <!-- Session Status -->
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- User Message -->
                    <p>{{ __('You are logged in!') }}</p>

                    <!-- Background Image -->
                    <img src="/modern/src/assets/images/backgrounds/bgklinik.png" alt="Background Image">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
