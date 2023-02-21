@extends('layouts.admin')

@section('content')
<div class="content-header pt-5 pb-4">
    <h1 class="text-orange text-center">Choose Your Sponsorship</h1>
</div>

<div class="payments text-center px-lg-5 pb-5">
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
            <form method="post" id="payment-form" action="">

                @csrf
                @method('POST')


                <div class="row row-cols-1 g-4 py-4 pb-4">
                    <div class="col ">
                        <div class="property mb-3 px-4">
                            <label for="property_id" class="form-label text-orange">
                                <h5>Please, select your Property</h5>
                            </label>
                            <select class="form-select form-select-md " name="property" id="property">
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
                                        <input type="radio" class="btn-check" name="sponsorship" id="secondary-outlined" autocomplete="off" value="{{$sponsorships[0]->id}}" checked>
                                        <label class="btn btn-outline-secondary" for="secondary-outlined">{{$sponsorships[0]->name}}</label>
                                    </div>
                                </div>

                                <div class="col pb-2">
                                    <div class="range text-center border border-warning rounded-3 p-3">
                                        <h6 class="text-warning">{{$sponsorships[1]->duration}} Hours</h6>
                                        <p class="text-warning">{{$sponsorships[1]->price}} &euro;</p>
                                        <input type="radio" class="btn-check" name="sponsorship" id="warning-outlined" autocomplete="off" value="{{$sponsorships[1]->id}}">
                                        <label class="btn btn-outline-warning" for="warning-outlined">{{$sponsorships[1]->name}}</label>
                                    </div>
                                </div>

                                <div class="col pb-2">
                                    <div class="range text-center border border-primary rounded-3 py-3">
                                        <h6 class="text-primary">{{$sponsorships[2]->duration}} Hours</h6>
                                        <p class="text-primary">{{$sponsorships[2]->price}} &euro;</p>
                                        <input type="radio" class="btn-check" name="sponsorship" id="primary-outlined" value="{{$sponsorships[2]->id}}" autocomplete="off">
                                        <label class="btn btn-outline-primary" for="primary-outlined">{{$sponsorships[2]->name}}</label>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <!-- /.Sponsorship -->
                    </div>
                </div>
                <div id="dropin-container" class="" style="margin: 0 auto; width:80%"></div>

                <input id="nonce" name="payment_method_nonce" type="hidden" />

                <button id="submit-button" class="button button--small button--green" type="submit">Purchase</button>
            </form>
        </div>
    </div>
</div>

<script src="https://js.braintreegateway.com/web/dropin/1.31.2/js/dropin.min.js"></script>
<script>
    var form = document.querySelector('#payment-form');
    var client_token = "sandbox_g42y39zw_348pk9cgf3bgyw2b";
    braintree.dropin.create({
        authorization: client_token,
        selector: '#dropin-container',
    }, function(createErr, instance) {
        if (createErr) {
            console.log('Create Error', createErr);
            return;
        }
        form.addEventListener('submit', function(event) {



            event.preventDefault();
            instance.requestPaymentMethod(function(err, payload) {
                if (err) {
                    console.log('Request Payment Method Error', err);
                    return;
                }
                // Add the nonce to the form and submit
                document.querySelector('#nonce').value = payload.nonce;
                setTimeout(function() {
                    form.submit();
                }, 1000);
            });
        });
    });
</script>
@endsection