@extends('layouts.admin')

@section('content')
    <div class="content-header py-5">
        <h1 class="text-orange text-center">Choose Your Sponsorship</h1>
    </div>
    <div class="row row-cols-1 row-cols-lg-2 g-4 py-5">
        <div class="col col-lg-4">
            <div class="property mb-5 px-4">
                <label for="property_id" class="form-label text-orange"><h5>Please, select your Property</h5></label>
                <select class="form-select form-select-md" name="property_id" id="property_id">
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
        </div>
        <!-- /.col -->
        <div class="col col-lg-8">
            <div class="sponsorships pb-4 px-4">
                <h5 class="text-orange mb-4">Check the Sponsorship</h5>
                <div class="row row-cols-1 row-cols-md-3">
                    <div class="col">
                        <div class="range text-center border border-secondary rounded-3 p-3">
                            <h6 class="text-secondary">{{$sponsorships[0]->duration}} Hours</h6>
                        <p class="text-secondary">{{$sponsorships[0]->price}} &euro;</p>
                        <input type="radio" class="btn-check" name="options-outlined" id="secondary-outlined" autocomplete="off" checked>
                        <label class="btn btn-outline-secondary" for="secondary-outlined">{{$sponsorships[0]->name}}</label>
                        </div>
                    </div>

                    <div class="col">
                        <div class="range text-center border border-warning rounded-3 p-3">
                            <h6 class="text-warning">{{$sponsorships[1]->duration}} Hours</h6>
                        <p class="text-warning">{{$sponsorships[1]->price}} &euro;</p>
                        <input type="radio" class="btn-check" name="options-outlined" id="warning-outlined" autocomplete="off">
                        <label class="btn btn-outline-warning" for="warning-outlined">{{$sponsorships[1]->name}}</label>
                        </div>
                    </div>
                    
                    <div class="col">
                        <div class="range text-center border border-primary rounded-3 p-3">
                            <h6 class="text-primary">{{$sponsorships[2]->duration}} Hours</h6>
                        <p class="text-primary">{{$sponsorships[2]->price}} &euro;</p>
                        <input type="radio" class="btn-check" name="options-outlined" id="primary-outlined" autocomplete="off">
                        <label class="btn btn-outline-primary" for="primary-outlined">{{$sponsorships[2]->name}}</label>
                        </div>
                        
                    </div>
                </div>

            </div>
            <!-- /.Sponsorship -->
        </div>
    </div>
    <!-- /.row -->
    <div class="payments text-center py-5">
        >>>PAYMENTS HERE!
    </div>
@endsection