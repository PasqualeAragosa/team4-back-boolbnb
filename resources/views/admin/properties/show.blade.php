@extends('layouts.admin')

@section('content')
<div class="content-header pt-5 px-5">
    <h1 class="text-orange">{{$property->title}}</h1>
    <!-- if there's an image, show it; otherwise, show a placeholder -->
    @if($property->image)
    <img class="img-fluid w-50" src="{{asset('storage/' . $property->image)}}" alt="">
    @else
    <div class="placeholder p-5 bg-secondary">Placeholder</div>
    @endif

</div>
<div class="content-body pt-3 px-5">
    <div class="info d-flex gap-5">
        <p class="text-orange">{{$property->price}} &euro;</p>
        <p class="text-orange"><i class="fa-solid fa-door-closed"></i> {{$property->rooms_num}}</p>
        <p class="text-orange"><i class="fa-solid fa-bed"></i> {{$property->beds_num}}</p>
        <p class="text-orange">{{$property->square_meters}} m</p>
    </div>
    <p>Address: {{$property->address}}</p>

    @if($property->visibility)
    <h5 class="text-orange">Available</h5>
    @else
    <h5 class="text-orange">Not available</h5>
    @endif
    <div class="description mb-3">
        {{$property->description}}
    </div>

    <!-- type -->
    <div class="type">
        <span>Type:</span>
        {{ $property->type ? $property->type->name : 'Uncategorized'}}
    </div>
    <!-- /.type -->

    <!-- amenities -->
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
</div>
<!-- /.amenities -->
@endsection