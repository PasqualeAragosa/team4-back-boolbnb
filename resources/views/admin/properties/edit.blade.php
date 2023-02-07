@extends('layouts.admin')

@section('content')

<div class="container mb-5">
    <h1 class="py-5">Update Property: {{$property->title}}</h1>

    @if ($errors->any())

    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($errors->all() as $error )
            <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>


    @endif

    <form action="{{route('admin.properties.update', $property->slug)}}" method="post" class="card p-3" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <!-- title -->
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control @error('image') is-invalid @enderror" placeholder="" aria-describedby="titleHlper" value="{{old('title', $property->title)}}" required minlength="5" maxlength="100">
            <small id="titleHlper" class="text-muted">Add the property title here</small>
        </div>
        @error('title')
        <div class="alert alert-danger" role="alert">
            {{$message}}
        </div>
        @enderror

        <!-- image -->
        <div class="mb-3 d-flex gap-4">
            <img width="140" src="{{ asset('storage/' . $property->image)}}" alt="">
            <div>
                <label for="image" class="form-label">Replace property Image</label>
                <input type="file" name="image" id="image" class="form-control  @error('image') is-invalid @enderror" placeholder="" aria-describedby="coverImageHelper" accept="image/*">
                <small id="coverImageHelper" class="text-muted">Replace the property image</small>
            </div>
        </div>
        @error('image')
        <div class="alert alert-danger" role="alert">
            {{$message}}
        </div>
        @enderror

        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" placeholder="" aria-describedby="priceHlper" value="{{old('price', $property->price)}}" min="1" max="9999">
            <small id="priceHlper" class="text-muted">Add the property price here</small>
        </div>
        @error('price')
        <div class="alert alert-danger" role="alert">
            {{$message}}
        </div>
        @enderror

        <div class="mb-3">
            <label for="rooms_num" class="form-label">Rooms</label>
            <input type="number" name="rooms_num" id="rooms_num" class="form-control @error('rooms_num') is-invalid @enderror" placeholder="" aria-describedby="roomHlper" value="{{old('rooms_num', $property->rooms_num)}}" min="1" max="100">
            <small id="roomHlper" class="text-muted">Add the property rooms here</small>
        </div>
        @error('rooms_num')
        <div class="alert alert-danger" role="alert">
            {{$message}}
        </div>
        @enderror


        <div class="mb-3">
            <label for="beds_num" class="form-label">Beds</label>
            <input type="number" name="beds_num" id="beds_num" class="form-control @error('beds_num') is-invalid @enderror" placeholder="" aria-describedby="bedHlper" value="{{old('beds_num', $property->beds_num)}}" min="1" max="100">
            <small id="bedHlper" class="text-muted">Add the property bed here</small>
        </div>
        @error('beds_num')
        <div class="alert alert-danger" role="alert">
            {{$message}}
        </div>
        @enderror

        <div class="mb-3">
            <label for="baths_num" class="form-label">Baths</label>
            <input type="number" name="baths_num" id="baths_num" class="form-control @error('baths_num') is-invalid @enderror" placeholder="" aria-describathby="bathHlper" value="{{old('baths_num', $property->baths_num)}}" min="1" max="100">
            <small id="bathHlper" class="text-muted">Add the property bath here</small>
        </div>
        @error('baths_num')
        <div class="alert alert-danger" role="alert">
            {{$message}}
        </div>
        @enderror

        <div class="mb-3">
            <label for="square_meters" class="form-label">Square meters</label>
            <input type="number" name="square_meters" id="square_meters" class="form-control @error('square_meters') is-invalid @enderror" placeholder="" aria-describedby="bedHlper" value="{{old('square_meters', $property->square_meters)}}" min="1" max="100">
            <small id="bedHlper" class="text-muted">Add the property square meters here</small>
        </div>
        @error('square_meters')
        <div class="alert alert-danger" role="alert">
            {{$message}}
        </div>
        @enderror


        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror" placeholder="" aria-describedby="titleHlper" value="{{old('address', $property->address)}}">
            <small id="titleHlper" class="text-muted">Add the property address here</small>
        </div>
        @error('address')
        <div class="alert alert-danger" role="alert">
            {{$message}}
        </div>
        @enderror

   

        <div class="mb-3 d-flex flex-column">
            <label for="visibility" class="form-label">Visibility</label>
            <div>
                <input type="checkbox" name="visibility" id="visibility" class="@error('visibility') is-invalid @enderror" placeholder="" aria-describedby="titleHlper" value="1" {{$property->visibility == true ? 'checked' : ''}}>
                <small id="titleHlper" class="text-muted">Add the property visibility here</small>
            </div>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="5" minlength="5" maxlength="255">{{old('description'), $property->description}}</textarea>
        </div>
        @error('description')
        <div class="alert alert-danger" role="alert">
            {{$message}}
        </div>
        @enderror
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

@endsection