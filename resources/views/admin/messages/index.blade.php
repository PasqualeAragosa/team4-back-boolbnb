@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="content-header d-flex justify-content-between align-items-center py-5">
        <h1 class="text-orange">Messages</h1>
    </div>

    <div class="row row-cols-1 row-cols-lg-2 g-4">
        @forelse ($messages as $message)
        <div class="col">
            <div class="card card-messages shadow border-0 p-4" style="height:100%">
                <div class="card-body">
                    <h5 class="card-title">From: {{ $message->guest_full_name }}</h5>
                    <p class="card-text">{{ $message->guest_email }}</p>
                    <p class="card-text">{{ $message->guest_phone_number }}</p>
                    <hr class="mb-0" style="border-top: 2px solid #ff8d34">
                </div>
                <div class="card-body">
                    @foreach($properties as $property)
                    @if($message->property_id == $property->id)
                    <h6 class="card-text">{{$property->title}}</h6>
                    @endif
                    @endforeach
                    <p class="card-text">{{ $message->content }}</p>
                </div>
            </div>
        </div>
        @empty
        <div class="col">
            <h2 class="mt-5">Sorry, no messages to show!</h2>
        </div>
        @endforelse
    </div>

</div>
@endsection