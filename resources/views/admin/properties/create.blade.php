@extends('layouts.admin')

@section('content')
<h1 class="text-orange py-5">Create a New Property</h1>
@include('partials.errors')
<form action="{{route('admin.properties.store')}}" method="post" class="card shadow border-0 p-4 mb-5" enctype="multipart/form-data" onsubmit="return validateForm()">
    @csrf

    <div class="mb-3">
        <label for="title" class="form-label text-orange">Title</label>
        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="Giulia's House" aria-describedby="helpTitle" value="{{old('title')}}" required minlength="5" maxlength="100">
        &ast;
        <small id="helpTitle" class="text-muted">Please Enter The Title</small>
    </div>
    <!-- /.Title -->
    <div class="mb-3">
        <label for="price" class="form-label text-orange">Price</label>
        <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" placeholder="€ 60,00" aria-describedby="helpRooms_num" value="{{old('price')}}" step="0.01" min="20" max="9999">
        <small id="helpPrice" class="text-muted">Please Enter The Price</small>
    </div>
    <!-- Rooms_num -->
    <div class="mb-3">
        <label for="rooms_num" class="form-label text-orange">Rooms</label>
        <input type="number" name="rooms_num" id="rooms_num" class="form-control @error('rooms_num') is-invalid @enderror" placeholder="4" aria-describedby="helpRooms_num" value="{{old('rooms_num')}}" min="1" max="100" required>
        <small id="helpRooms_num" class="text-muted">Please Enter The Total Rooms</small>
    </div>
    <!-- /.Rooms_num -->
    <div class="mb-3">
        <label for="beds_num" class="form-label text-orange">Beds</label>
        <input type="number" name="beds_num" id="beds_num" class="form-control @error('beds_num') is-invalid @enderror" placeholder="2" aria-describedby="helpBeds_num" value="{{old('beds_num')}}" min="1" max="100" required>
        <small id="helpBeds_num" class="text-muted">Please Enter The Total Beds</small>
    </div>
    <!-- /.Beds_num -->

    <div class="mb-3">
        <label for="baths_num" class="form-label text-orange">Baths</label>
        <input type="number" name="baths_num" id="baths_num" class="form-control @error('baths_num') is-invalid @enderror" placeholder="1" aria-describedby="helpBaths_num" value="{{old('baths_num')}}" min="1" max="100">
        <small id="helpBaths_num" class="text-muted">Please Enter The Total Baths</small>
    </div>
    <!-- /.Baths_num -->

    <div class="mb-3">
        <label for="square_meters" class="form-label text-orange">Square meters</label>
        <input type="number" name="square_meters" id="square_meters" class="form-control @error('square_meters') is-invalid @enderror" placeholder="80 mq" aria-describedby="helpSquare_meters" value="{{old('square_meters')}}" min="10" max="1000">
        <small id="helpSquare_meters" class="text-muted">Please Enter The Square Meters</small>
    </div>
    <!-- /.Square_meters -->

    <!-- Type -->
    <div class="mb-3">
        <label for="type_id" class="form-label text-orange">Type</label>
        <select class="form-select form-select-md @error('type_id') 'is-invalid' @enderror" name="type_id" id="type_id">
            <option disabled selected value="">Select a Type</option>

            @foreach ($types as $type)
            <option value="{{$type->id}}" {{ old('type_id') ? 'selected' : '' }}>{{$type->name}}</option>
            @endforeach

        </select>
    </div>
    <!-- /.Type -->

    <!-- Amenity -->
    <div class="mb-3">
        <label for="amenities" class="form-label text-orange">Please select the Amenity</label>

        <div class="d-flex flex-wrap checkbox" id="checkbox">
            @forelse ($amenities as $amenity)
            <div class="p-2 d-flex align-items-center" style="width: 200px">
                <input type="checkbox" name="amenities[]" id="amenities" value="{{$amenity->id}}" {{ in_array($amenity->id, old('amenities', [])) ? 'checked' : '' }}>
                <p class="ms-2 m-0">{{ $amenity->name }}</p>
            </div>
            @empty
            <h4>No amenities added yet in the database</h4>
            @endforelse
        </div>
    </div>
    <!-- /.Amenity -->

    <!-- Address -->
    <div class="mb-3 address">
        <label for="address" class="form-label text-orange">Address</label>
    </div>
    <!-- /.Address -->

    <div class="mb-3">
        <label for="image" class="form-label text-orange">Image</label>
        <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" aria-describedby="helpImage" value="" accept="image/*">
        <small id="helpImage" class="text-muted">Please Enter The Image</small>
    </div>
    <!-- /.Image -->

    <div class="mb-3">
        <label for="description" class="form-label text-orange">Description</label>
        <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="5" minlength="5">{{old('description')}}</textarea>
        <small id="helpDescription" class="text-muted">Please Enter The Description</small>
    </div>
    <!-- /.Description -->

    <div class="mb-3 d-flex flex-column">
        <label for="visibility" class="form-label text-orange">Is the property available ?</label>
        <div>
            <input type="radio" name="visibility" id="visibility" value="1">
            <small id="helpVisibility" class="text-muted">Please Check if available</small>
        </div>
    </div>
    <!-- /.Visibility -->

    <div class="d-flex justify-content-between">
        <button type="submit" class="btn bck-orange rounded-pill text-white text-uppercase">Submit</button>
        <a href="{{route('admin.properties.index')}}" class="btn bck-orange text-white">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
            </svg>
        </a>
    </div>
</form>

@include('partials.validation')

@include('partials.autocomplete')

<script>
    function validateForm() {
        // Seleziono tutti checkbox
        let checkbox = document.querySelectorAll('input[type="checkbox"]');
        let marked_checkboxes = [];

        // Se un checkbox è stato selezionato viene inserito nell'array 
        checkbox.forEach((check_box) => {
            if (check_box.checked) {
                marked_checkboxes.push(check_box);
            }
        });

        if (marked_checkboxes.length < 1) {
            document.getElementById("checkbox").setAttribute("class", "d-flex flex-wrap checkbox error");
            return false;
        } else {
            return true;
        }
    }
</script>
@endsection