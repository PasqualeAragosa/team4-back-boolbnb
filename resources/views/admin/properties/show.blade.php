@extends('layouts.admin')

@section('content')

<div class="content-header p-5 mb-4">
    <div class="row row-cols-1 row-cols-md-2">
        <div class="col d-flex justify-content-center align-items-center">
            <div class="property_title text-center px-3">
                <h1 class="text-orange">{{$property->title}}</h1>
                <p>Address: {{$property->address}}</p>
                <hr>
                <h2 class="text-orange">{{$property->price}} &euro;</h2>
                @if($property->visibility)
                <h3 class="text-orange">Available</h3>
                @else
                <h3>Not available</h3>
                @endif
            </div>
        </div>
        <div class="col">
           <div class="img-gallery overflow-hidden">
             <!-- if there's an image, show it; otherwise, show a placeholder -->
             @if($property->image)
             <img class="img-fluid photo-zoom" src="{{asset('storage/' . $property->image)}}" alt="">
             @else
             <div class="placeholder p-5 bg-secondary">Placeholder</div>
             @endif
           </div>
        </div>
    </div>
</div>
<div class="content-body pt-5 px-5">
    <div class="row row-cols-1 row-cols-md-2">
        <div class="col text-center">
            <div class="info d-flex justify-content-around mb-3">
                <h4 class="text-orange"><i class="fa-solid fa-door-closed"></i> {{$property->rooms_num}}</h4>
                <h4 class="text-orange"><i class="fa-solid fa-bed"></i> {{$property->beds_num}}</h4>
                <h4 class="text-orange">{{$property->square_meters}} &#13217;</h4>
            </div>
            <div class="description mb-3">
                {{$property->description}}
            </div>
             <!-- type -->
    <div class="type">
        <span>Type:</span>
        {{ $property->type ? $property->type->name : 'Uncategorized'}}
    </div>
    <!-- /.type -->
            <div class="amenities">
                <h5 class="text-orange">Amenities:</h5>
                @if(count($property->amenities) > 0 )
            
            
                @foreach ($property->amenities as $amenity)
                <span>{{$amenity->name}} </span>
                @endforeach
            
                @else
                <span>Not Amenities associated to the property</span>
                @endif
            
            </div>
        </div>
        <div class="col">
           <div class="maps text-center">
            ...MAPS HERE!
           </div>
        </div>
    </div>



</div>
@endsection