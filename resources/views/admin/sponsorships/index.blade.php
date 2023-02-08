@extends('layouts.admin')



@section('content')

<div class="container">
    <div class="row">
        <div class="col">
            <!-- Property -->
            <div class="mb-3">
                <label for="property_id" class="form-label">Please select the Property</label>
                <select class="form-select form-select-lg" name="property_id" id="property_id">
                    <option disabled value=''>Select one</option>
                    @forelse ($properties as $property)
                    <option value="{{ $property->id }}" {{ $property->id == old('property_id') ? 'selected' : '' }}>
                        {{ $property->title }}
                    </option>
                    @empty
                    <option>No properties added yet in the database</option>
                    @endforelse
                </select>
            </div>
            <!-- /.Property -->

            <!-- Sponsorship -->

            <div class="mb-3">
                <label for="sponsorship">Check the Sponsorship</label>

                <div class="d-flex flex-column gap-4">
                    <input type="radio" class="btn-check" name="options-outlined" id="secondary-outlined" autocomplete="off" checked>
                    <label class="btn btn-outline-secondary w-75" for="secondary-outlined">{{$sponsorships[0]->name}}</label>

                    <input type="radio" class="btn-check" name="options-outlined" id="warning-outlined" autocomplete="off">
                    <label class="btn btn-outline-warning w-75" for="warning-outlined">{{$sponsorships[1]->name}}</label>

                    <input type="radio" class="btn-check" name="options-outlined" id="primary-outlined" autocomplete="off">
                    <label class="btn btn-outline-primary w-75" for="primary-outlined">{{$sponsorships[2]->name}}</label>
                </div>

            </div>
            <!-- /.Sponsorship -->
        </div>
        <!-- /.col -->
        <div class="col">

        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>
<!-- /.container -->




@endsection