@extends('layouts.admin')

@section('content')
<div class="content-header d-flex flex-column flex-md-row justify-content-between align-items-center py-5">
    <h1 class="text-orange">Properties</h1>
    <a class="btn bck-orange rounded-pill text-white px-3" href="{{route('admin.properties.create')}}" role="button">
        Add <i class="fa-solid fa-plus"></i>
    </a>
</div>
@include('partials.message')
@include('partials.danger')

<div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 pb-5">
    @foreach($properties as $property)
    <div class="col">
        <div class="card card-properties shadow border-0" style="height:100%">
            <div class="image overflow-hidden">
                @if($property->image)
                <img class="card-img-top img-fluid photo-zoom" src="{{asset('storage/' . $property->image)}}" alt="">
                @else
                <img class="card-img-top img-fluid" src="/images/placeholder.png" alt="">
                @endif
            </div>

            <!-- Banner Sponsorizzazione -->
            @if($sponsored)
            @foreach($pivotProperty as $key => $el)
            @if($property->id === $el)
            <div class="counter d-flex p-2 bg-warning text-white">
                <div class="counter_block">
                    <div class="cb_number">
                        @if($pivotSponsorship[$key] == 1)
                        Sponsored 24 H
                        @elseif ($pivotSponsorship[$key] == 2)
                        Sponsored 72 H
                        @elseif ($pivotSponsorship[$key] == 3)
                        Sponsored 144 H
                        @endif
                    </div>
                </div>
            </div>
            @endif
            @endforeach
            @endif

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