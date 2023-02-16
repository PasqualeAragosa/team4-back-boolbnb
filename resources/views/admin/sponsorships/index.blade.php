@extends('layouts.admin')

@section('content')
    <div class="content-header pt-5 pb-4">
        <h1 class="text-orange text-center">Choose Your Sponsorship</h1>
    </div>

    <div class="payments text-center px-5">
        <div class="wrapper px-lg-5">
            <div class="checkout container">
                @if (session()->has('success_message'))
                <div class="alert alert-success">
                    {{ session()->get('success_message') }}
                </div>
                @endif
    
                @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                <form method="post" id="payment-form" action="" id="payment-form">
                    @csrf
                    @method('POST')

                    <div class="row row-cols-1 g-4 py-4">
                        <div class="col ">
                            <div class="property mb-3 px-4">
                                <label for="property_id" class="form-label text-orange"><h5>Please, select your Property</h5></label>
                                <select class="form-select form-select-md " name="property_id" id="property_id">
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
                        <div class="col ">
                            <div class="sponsorships pb-3 px-4">
                                <h5 class="text-orange mb-4">Check the Sponsorship</h5>
                                <div class="row row-cols-1 row-cols-sm-3">
                                    <div class="col pb-2">
                                        <div class="range text-center border border-secondary rounded-3 p-3">
                                            <h6 class="text-secondary">{{$sponsorships[0]->duration}} Hours</h6>
                                        <p class="text-secondary">{{$sponsorships[0]->price}} &euro;</p>
                                        <input type="radio" class="btn-check" name="options-outlined" id="secondary-outlined" autocomplete="off" checked>
                                        <label class="btn btn-outline-secondary" for="secondary-outlined">{{$sponsorships[0]->name}}</label>
                                        </div>
                                    </div>
                
                                    <div class="col pb-2">
                                        <div class="range text-center border border-warning rounded-3 p-3">
                                            <h6 class="text-warning">{{$sponsorships[1]->duration}} Hours</h6>
                                        <p class="text-warning">{{$sponsorships[1]->price}} &euro;</p>
                                        <input type="radio" class="btn-check" name="options-outlined" id="warning-outlined" autocomplete="off">
                                        <label class="btn btn-outline-warning" for="warning-outlined">{{$sponsorships[1]->name}}</label>
                                        </div>
                                    </div>
                                    
                                    <div class="col pb-2">
                                        <div class="range text-center border border-primary rounded-3 py-3">
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
                    <div for="credit-card p-5">
                       <div class="card-top">
                        <h5 class="text-orange mb-4"><i class="fa-regular fa-credit-card"></i> Pay with card</h5>
                       </div>
                        
                        <div class="mb-3 row">
                               <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Fullname') }}</label>
                               <div class="col-md-6">
                                   <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autofocus>
                               </div>
                        </div>
                        <!-- /.Name -->

                        <div class="mb-3 row">
                            <label for="credit-card-number" class="col-md-4 col-form-label text-md-end">{{ __('CC Number') }}</label>
                            <div class="col-md-6">
                               <input id="credit-card-number" type="number" class="form-control @error('credit-card-number') is-invalid @enderror" name="credit-card-number" value="{{ old('credit-card-number') }}" autofocus>
                            </div>
                        </div>
                        <!-- /.credit-card-number -->    

                        <div class="mb-3 row">
                            <label for="expire_date" class="col-md-4 col-form-label text-md-end">{{ __('Expire Date') }}</label>
                            <div class="col-md-6">
                                <input id="expire_date" type="date" class="form-control @error('expire_date') is-invalid @enderror" name="expire_date" value="{{ old('expire_date') }} " autofocus>

                            </div>
                        </div>
                        <!-- /.expire_date -->    

                        <div class="mb-3 row">
                            <label for="CVV" class="col-md-4 col-form-label text-md-end">{{ __('CVV*') }}</label>
                            <div class="col-md-6">
                                <input id="CVV" type="number" class="form-control @error('CVV') is-invalid @enderror" name="CVV" value="{{ old('CVV') }}" required autofocus>
                            </div>
                        </div>
                        <!-- /.CVV -->    
                    </div>
                    <button class="btn bck-orange rounded-pill text-white mt-4" type="submit"><span>Request payment method</span></button>
                </form>
            </div>
        </div>
    </div>
@endsection

<script>
    var valid = require("card-validator");

var numberValidation = valid.number("4111");

if (!numberValidation.isPotentiallyValid) {
  renderInvalidCardNumber();
}

if (numberValidation.card) {
  console.log(numberValidation.card.type); // 'visa'
}
</script>