@extends('layouts.admin')

@section('content')

<h1 class="text-orange py-5">Update Property: {{$property->title}}</h1>

@if ($errors->any())
<div class="alert alert-danger" role="alert">
    <ul>
        @foreach ($errors->all() as $error )
        <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{route('admin.properties.update', $property->slug)}}" method="post" class="card shadow border-0 p-4 mb-5" enctype="multipart/form-data" onsubmit="return validateForm()">
    @csrf
    @method('PUT')
    <!-- title -->
    <div class="mb-3">
        <label for="title" class="form-label text-orange">Title</label>
        <input type="text" name="title" id="title" class="form-control @error('image') is-invalid @enderror" placeholder="" aria-describedby="titleHlper" value="{{old('title', $property->title)}}" required minlength="5" maxlength="100">
        &ast;
        <small id="titleHlper" class="text-muted">Add the property title here</small>
    </div>
    @error('title')
    <div class="alert alert-danger" role="alert">
        {{$message}}
    </div>
    @enderror

    <div class="mb-3">
        <label for="price" class="form-label text-orange">Price</label>
        <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" placeholder="€ 60,00" aria-describedby="priceHlper" value="{{old('price', $property->price)}}" step="0.01" min="20" max="9999">
        <small id="priceHlper" class="text-muted">Update The Price</small>
    </div>
    @error('price')
    <div class="alert alert-danger" role="alert">
        {{$message}}
    </div>
    @enderror


    <div class="mb-3">
        <label for="rooms_num" class="form-label text-orange">Rooms</label>
        <input type="number" name="rooms_num" id="rooms_num" class="form-control @error('rooms_num') is-invalid @enderror" placeholder="4" aria-describedby="roomHlper" value="{{old('rooms_num', $property->rooms_num)}}" min="1" max="100">
        <small id="roomHlper" class="text-muted">Update The Total Rooms</small>
    </div>
    @error('rooms_num')
    <div class="alert alert-danger" role="alert">
        {{$message}}
    </div>
    @enderror


    <div class="mb-3">
        <label for="beds_num" class="form-label text-orange">Beds</label>
        <input type="number" name="beds_num" id="beds_num" class="form-control @error('beds_num') is-invalid @enderror" placeholder="2" aria-describedby="bedHlper" value="{{old('beds_num', $property->beds_num)}}" min="1" max="100">
        <small id="bedHlper" class="text-muted">Update the Total Beds</small>
    </div>
    @error('beds_num')
    <div class="alert alert-danger" role="alert">
        {{$message}}
    </div>
    @enderror

    <div class="mb-3">
        <label for="baths_num" class="form-label text-orange">Baths</label>
        <input type="number" name="baths_num" id="baths_num" class="form-control @error('baths_num') is-invalid @enderror" placeholder="1" aria-describathby="bathHlper" value="{{old('baths_num', $property->baths_num)}}" min="1" max="100">
        <small id="bathHlper" class="text-muted">Update the Total Baths</small>
    </div>
    @error('baths_num')
    <div class="alert alert-danger" role="alert">
        {{$message}}
    </div>
    @enderror

    <div class="mb-3">
        <label for="square_meters" class="form-label text-orange">Square meters</label>
        <input type="number" name="square_meters" id="square_meters" class="form-control @error('square_meters') is-invalid @enderror" placeholder="80 mq" aria-describedby="bedHlper" value="{{old('square_meters', $property->square_meters)}}" min="10" max="1000">
        <small id="bedHlper" class="text-muted">Please update the Square Meters</small>
    </div>
    @error('square_meters')
    <div class="alert alert-danger" role="alert">
        {{$message}}
    </div>
    @enderror

    <!-- Type -->
    <div class="mb-3">
        <label for="type_id" class="form-label text-orange">Types</label>
        <select class="form-select form-select-md @error('type_id') 'is-invalid' @enderror" name="type_id" id="type_id">
            <option disabled selected value="">Update Type</option>

            @forelse ($types as $type)
            <option value="{{$type->id}}" {{ $type->id == old('type_id',  $property->type ? $property->type->id : '') ? 'selected' : '' }}>
                {{$type->name}}
            </option>
            @empty
            <option value="">No Types in the system.</option>
            @endforelse


        </select>
    </div>
    <!-- /.Type -->

    <!-- Amenity -->
    <div class="mb-3">
        <label for="amenities" class="form-label text-orange">Amenity</label>
        <div class="d-flex flex-wrap" id="checkbox">
            @forelse ($amenities as $amenity)

            @if ($errors->any())
            <!-- Page with errors validation -->
            <div class="p-2 d-flex align-items-center" style="width: 200px">
                <input type="checkbox" name="amenities[]" id="amenities" value="{{$amenity->id}}" {{ in_array($amenity->id, old('amenities', [])) ? 'checked' : '' }}>
                <p class="ms-2 m-0">{{ $amenity->name }}</p>
            </div>
            @else
            <!-- Page loaded for the first time: must show the pre-selected Amenities from the db -->
            <div class="p-2 d-flex align-items-center" style="width: 200px">
                <input type="checkbox" name="amenities[]" id="amenities" value="{{$amenity->id}}" {{ $property->amenities->contains($amenity->id) ? 'checked' : ''}}>
                <p class="ms-2 m-0">{{ $amenity->name }}</p>
            </div>
            @endif
            @empty
            <h4>No amenities added yet in the database</h4>
            @endforelse
        </div>
    </div>
    <!-- /.Amenity -->
    <div class="mb-3 address">
        <label for="address" class="form-label text-orange">Address</label>
    </div>
    @error('address')
    <div class="alert alert-danger" role="alert">
        {{$message}}
    </div>
    @enderror

    <!-- image -->
    <div class="mb-3 d-flex gap-4">
        <img width="140" src="{{ asset('storage/' . $property->image)}}" alt="">
        <div>
            <label for="image" class="form-label text-orange">Replace property Image</label>
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
        <label for="description" class="form-label text-orange">Description</label>
        <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="5" minlength="5" maxlength="255">{{old('description', $property->description)}}</textarea>
        <small id="helpDescription" class="text-muted">Please Update The Description</small>
    </div>
    @error('description')
    <div class="alert alert-danger" role="alert">
        {{$message}}
    </div>
    @enderror

    <div class="mb-3 d-flex flex-column">
        <label for="visibility" class="form-label text-orange">Visibility</label>
        <div>
            <input type="radio" name="visibility" id="visibility" class="@error('visibility') is-invalid @enderror" placeholder="" aria-describedby="titleHlper" value="1" {{$property->visibility == true ? 'checked' : ''}}>
            <small id="titleHlper" class="text-muted">Update the visibility here</small>
        </div>
    </div>
    <button type="submit" class="btn bck-orange text-white rounded-pill w-25 my-4">Submit</button>
</form>

@include('partials.validation')

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
            document.getElementById("checkbox").setAttribute("class", "d-flex flex-wrap checkbox democlass");
            return false;
        } else {
            return true;
        }
    }

    const options = {
        searchOptions: {
            key: "dcEQtI4NS1isWSGpD7hptIGNCBFbNbcC",
            language: "en-GB",
            limit: 5,
        },
        autocompleteOptions: {
            key: "dcEQtI4NS1isWSGpD7hptIGNCBFbNbcC",
            language: "en-GB",
        },
    };
    const ttSearchBox = new tt.plugins.SearchBox(tt.services, options);
    const searchBoxHTML = ttSearchBox.getSearchBoxHTML();

    const smallAddress = `<small id="helpAddress" class="text-muted"> &ast; Please Enter The Address</small>`

    const address = document.querySelector('.address');

    address.insertAdjacentElement('beforeend', searchBoxHTML);
    address.insertAdjacentHTML('beforeend', smallAddress);

    const inputSearchBox = document.querySelector("input.tt-search-box-input");

    inputSearchBox.setAttribute("id", "address"); // add id
    inputSearchBox.setAttribute("name", "address"); // name
    inputSearchBox.setAttribute("required", ''); // add required
    inputSearchBox.setAttribute("placeholder", "Via Roma 34...");
    inputSearchBox.setAttribute("value", "{{old('address', $property->address)}}");
</script>
@endsection