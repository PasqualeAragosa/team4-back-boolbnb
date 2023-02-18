@extends('layouts.admin')

@section('content')
<div class="content-header d-flex justify-content-between align-items-center py-5">
    <h1 class="text-orange">Properties</h1>
    <a class="btn bck-orange rounded-pill text-white px-3" href="{{route('admin.properties.create')}}" role="button">
        Add property <i class="fa-solid fa-plus"></i>
    </a>
</div>
@include('partials.message')

<div class="row row-cols-1 row-cols-md-4 g-4 mb-4">
    @foreach($properties as $property)
    <div class="col">
        <div class="card card-properties shadow border-0" style="height:100%">
            <div class="image overflow-hidden">
                @if($property->image)
                <img class="card-img-top img-fluid photo-zoom"  src="{{asset('storage/' . $property->image)}}" alt="">
                @else
                <img class="card-img-top img-fluid" src="/images/placeholder.png" alt="">
                @endif
            </div>
            <!--if(property->sponsorship)-->
            <div class="counter d-flex p-2 bg-warning text-white">
                <div class="counter_block dd">
                    <div id="days" class="cb_number"></div>
                </div>
                <div class="counter_block hh">
                    <div id="hours" class="cb_number">6</div>
                </div>
                <div class="counter_block mm">
                    <div id="minutes" class="cb_number">12</div>
                </div>
                <div class="counter_block ss">
                    <div id="seconds" class="cb_number">20</div>
                </div>
            </div>
            <!--endif-->
            <div class="card-body  p-4">
                <h5 class="card-title">{{$property->title}}</h5>
                <p class="card-text">{{$property->address}}</p>
                @if($property->visibility)
                <p class="card-text text-orange"><small>Available</small></p>
                @else
                <p class="card-text text-orange"><small>Not available</small></p>
                @endif
            </div>
            <div class="card-body text-center">
                <a href="{{route('admin.properties.show', $property->slug)}}" class="btn btn-primary">
                    <i class="fa-solid fa-eye"></i>
                </a>
                <!-- /.Show -->
                <a href="{{route('admin.properties.edit', $property->slug)}}" class="btn btn-secondary my-2">
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>
                <!-- /.Create -->
                <button type="button" class="btn btn-danger btn-md" data-bs-toggle="modal" data-bs-target="#deleteProperty-{{$property->slug}}">
                    <i class="fa-solid fa-trash-can"></i>
                </button>
                @include('partials.modal')
                 <!-- /.Delete -->
            </div>
        </div>
    </div>
    @endforeach
</div>
{{ $properties->links('vendor.pagination.bootstrap-5') }}

@endsection