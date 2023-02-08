@extends('layouts.admin')

@section('content')
<div class="container admin-form mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card p-4 shadow border-0">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body text-center">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
