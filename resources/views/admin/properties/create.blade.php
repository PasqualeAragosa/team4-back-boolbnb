@extends('layouts.admin')



@section('content')
<div class="container">
    <h1>Create a New Property</h1>
    @include('partials.errors')
    <form action="{{route('admin.properties.store')}}" method="post" enctype="multipart/form-data">
        @csrf

        <!-- Title -->
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="Write Title" aria-describedby="helpTitle" value="{{old('title')}}" required minlength="5" maxlength="100">
            <small id="helpTitle" class="text-muted">Please Enter The Title</small>
        </div>
        <!-- /.Title -->

        <!-- Price -->
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" placeholder="Write Title" aria-describedby="helpRooms_num" value="{{old('price')}}" min="1" max="9999">
            <small id="helpPrice" class="text-muted">Please Enter The Price</small>
        </div>
        <!-- /.Price -->


        <!-- Rooms_num -->
        <div class="mb-3">
            <label for="rooms_num" class="form-label">Rooms</label>
            <input type="number" name="rooms_num" id="rooms_num" class="form-control @error('rooms_num') is-invalid @enderror" placeholder="Write Title" aria-describedby="helpRooms_num" value="{{old('rooms_num')}}" min="1" max="100">
            <small id="helpRooms_num" class="text-muted">Please Enter The Rooms_num</small>
        </div>
        <!-- /.Rooms_num -->

        <!-- Beds_num -->
        <div class="mb-3">
            <label for="beds_num" class="form-label">Beds</label>
            <input type="number" name="beds_num" id="beds_num" class="form-control @error('beds_num') is-invalid @enderror" placeholder="Write Title" aria-describedby="helpBeds_num" value="{{old('beds_num')}}" min="1" max="100">
            <small id="helpBeds_num" class="text-muted">Please Enter The Beds_num</small>
        </div>
        <!-- /.Beds_num -->

        <!-- Baths_num -->
        <div class="mb-3">
            <label for="baths_num" class="form-label">Baths</label>
            <input type="number" name="baths_num" id="baths_num" class="form-control @error('baths_num') is-invalid @enderror" placeholder="Write Title" aria-describedby="helpBaths_num" value="{{old('baths_num')}}" min="1" max="100">
            <small id="helpBaths_num" class="text-muted">Please Enter The Baths_num</small>
        </div>
        <!-- /.Baths_num -->

        <!-- Square_meters -->
        <div class="mb-3">
            <label for="square_meters" class="form-label">Square meters</label>
            <input type="number" name="square_meters" id="square_meters" class="form-control @error('square_meters') is-invalid @enderror" placeholder="Write Title" aria-describedby="helpSquare_meters" value="{{old('square_meters')}}" min="10" max="1000">
            <small id="helpSquare_meters" class="text-muted">Please Enter The Square Meters</small>
        </div>
        <!-- /.Square_meters -->

        <!-- Address -->
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror" placeholder="Write Title" aria-describedby="helpAddress" value="{{old('address')}}">
            <small id="helpAddress" class="text-muted">Please Enter The Address</small>
        </div>
        <!-- /.Address -->

        <!-- Image -->
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" placeholder="Write Title" aria-describedby="helpImage" value="" accept="image/*">
            <small id="helpImage" class="text-muted">Please Enter The Image</small>
        </div>
        <!-- /.Image -->

        <!-- Description -->
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="5" minlength="5" maxlength="255">{{old('description')}}</textarea>
            <small id="helpDescription" class="text-muted">Please Enter The Description</small>
        </div>
        <!-- /.Description -->


        <!-- Visibility -->
        <div class="mb-3 d-flex flex-column">
            <label for="visibility" class="form-label">Is the property available ?</label>
            <div>
                <input type="checkbox" name="visibility" id="visibility" value="1">
                <small id="helpVisibility" class="text-muted">Please Check if available</small>
            </div>
        </div>
        <!-- /.Visibility -->


        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary text-uppercase">Submit</button>
            <a href="{{route('admin.properties.index')}}" class="btn btn-info">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                </svg>
            </a>
        </div>
    </form>
</div>
<!-- /.container -->
@endsection