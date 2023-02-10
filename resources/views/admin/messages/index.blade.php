@extends('layouts.admin')

@section('content')

<div class="container">
    <h1>Messages</h1>

    <table class="table mt-4 table-striped">
        <thead>
            <tr>
                <td>Name</td>
                <td>Email</td>
                <td>Phone</td>
                <td>Property</td>
                <td colspan="2">Message</td>
            </tr>
        </thead>
        <tbody>
            @forelse ($messages as $message)
            <tr>
                <td> {{ $message->guest_full_name }} </td>
                <td> {{ $message->guest_email }} </td>
                <td> {{ $message->guest_phone_number }} </td>
                <td>
                    @foreach($properties as $property)
                    @if($message->property_id == $property->id)
                    {{$property->title}}
                    @endif
                    @endforeach
                </td>
                <td colspan="2">{{ $message->content }}</td>
            </tr>
            @empty
            <tr class="table-primary">
                <td scope="row">Sorry no messages to show</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection