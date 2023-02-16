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
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="">
                    <span>Amount: <strong>sponsorship €</strong></span>
                </div>
                <div class="card">
                    <form action=""  method="post" id="payment-form">
                        @csrf                    
                        <div class="form-group">
                            <div class="card-header">
                                <label for="card-element">
                                    Enter your credit card information
                                </label>
                            </div>
                            <div class="card-body">
                                <div id="card-element">
                                <!-- A Stripe Element will be inserted here. -->
                                </div>
                                <!-- Used to display form errors. -->
                                <div id="card-errors" role="alert"></div>
                                <input type="hidden" name="plan" value="" />
                            </div>
                        </div>
                        <div class="card-footer">
                          <button
                          id="card-button"
                          class="btn btn-dark"
                          type="submit"
                          data-secret="{{ $intent }}"
                        > Pay </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
    // Custom styling can be passed to options when creating an Element.
    // (Note that this demo uses a wider set of styles than the guide below.)
    var style = {
        base: {
            color: '#32325d',
            lineHeight: '18px',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
                color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
    };

    const stripe = Stripe('pk_test_51Kk6zsHQslSFqM4OykHx2KpKc1DIfh8kR1pHnrnwXfifgqsxS27fbpKxzbtCUT98pgZv1xWWigiRuxqANIlXZHfx002zKBSp9Q', { locale: 'en' }); // Create a Stripe client.
    const elements = stripe.elements(); // Create an instance of Elements.
    const cardElement = elements.create('card', { style: style }); // Create an instance of the card Element.
    const cardButton = document.getElementById('card-button');
    const clientSecret = cardButton.dataset.secret;

    cardElement.mount('#card-element'); // Add an instance of the card Element into the `card-element` <div>.

    // Handle real-time validation errors from the card Element.
    cardElement.addEventListener('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });

    // Handle form submission.
    var form = document.getElementById('payment-form');

    form.addEventListener('submit', function(event) {
        event.preventDefault();

    stripe.handleCardPayment(clientSecret, cardElement, {
            payment_method_data: {
                //billing_details: { name: cardHolderName.value }
            }
        })
        .then(function(result) {
            console.log(result);
            if (result.error) {
                // Inform the user if there was an error.
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
            } else {
                console.log(result);
                form.submit();
            }
        });
    });
</script>
@endsection