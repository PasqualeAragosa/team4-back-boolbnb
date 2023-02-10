@extends('layouts.admin')

@section('content')

<!-- if there's an image, show it; otherwise, show a placeholder -->
@if($property->image)
<img class="img-fluid w-50" src="{{asset('storage/' . $property->image)}}" alt="">
@else
<div class="placeholder p-5 bg-secondary">Placeholder</div>
@endif



<h1>{{$property->title}}</h1>
<p>Price: {{$property->price}}</p>
<p>Rooms: {{$property->rooms_num}}</p>
<p>Beds: {{$property->beds_num}}</p>
<p>Square Meters: {{$property->square_meters}}</p>

<div class="amenities">
    <span>Amenities:</span>
    @if(count($property->amenities) > 0 )


    @foreach ($property->amenities as $amenity)
    <span>{{$amenity->name}}</span>
    @endforeach

    @else
    <span>Not Amenities associated to the property</span>
    @endif

</div>

<p>Address: {{$property->address}}</p>
@if($property->visibility)
<p>Visibility: available</p>
@else
<p>Visibility: not available</p>
@endif

<div class="description">
    {{$property->description}}
</div>
@endsection