@extends('layouts.admin')

@section('content')
<div class="content-header admin-form">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card py-5 border-0">
                <div class="card-header">Hi {{ Auth::user()->name }}!</div>
                <div class="card-body text-center" style="border-bottom: 2px solid #ff8d34">
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
<div class="content-body p-5">
    <div class="row row-cols-1 row-cols-lg-3 gap-4 gap-lg-0">
        <div class="col">
            <div class="card text-center" style="border: 2px solid #ff8d34; height:100%">
                <div class="card-title p-3" style="border-bottom: 1px solid #ff8d34">
                    <h4 class="text-orange"><i class="fa-solid fa-house-user"></i> Properties</h4>
                </div>
                <div class="card-body">
                    <p>You have <strong class="text-orange">{{Auth::user()->properties->count()}}</strong> properties</p>

                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-center" style="border: 2px solid #ff8d34 ; height:100%">
                <div class="card-title p-3" style="border-bottom: 1px solid #ff8d34">
                    <h4 class="text-orange"><i class="fa-solid fa-hand-holding-dollar"></i> Sponsorships</h4>
                </div>
                <div class="card-body">
                    <p>You have <strong class="text-orange">--</strong> sponsorized properties</p>

                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-center" style="border: 2px solid #ff8d34; height:100%">
                <div class="card-title p-3" style="border-bottom: 1px solid #ff8d34">
                    <h4 class="text-orange"><i class="fa-regular fa-envelope"></i> Messages</h4>
                </div>
                <div class="card-body">
                    <p>You have <strong class="text-orange">--</strong> messages</p>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
