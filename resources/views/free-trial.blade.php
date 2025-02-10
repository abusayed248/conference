<x-app-layout>

<div class="container mt-5">
        <div class="row justify-content-center">
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="col-md-6">
                    @php
                    $freeTrialEnd = auth()->user()->free_trial;
                    $freeTrialCancel = auth()->user()->is_cancel_free_trial;
                    $today = now();
                    @endphp

                    @if ($freeTrialEnd)



                    @if ($freeTrialCancel)
                    <div class="alert alert-danger text-center">
                        Your free trial has ended. Please cancel your free trial.
                    </div>


                    @else

                    @if ($today->lessThanOrEqualTo($freeTrialEnd))
                    <div class="alert alert-success text-center">
                        Your free trial is active until {{ \Carbon\Carbon::parse($freeTrialEnd)->format('F d, Y h:i A') }}.
                    </div>

                    <!-- Cancel Free Trial Button -->
                    <form method="POST" action="{{ route('subscription.free-trial.cancel') }}">
                        @csrf
                        <button type="submit" class="btn btn-danger w-100 mt-3">Cancel Free Trial</button>
                    </form>
                    @else
                    <div class="alert alert-danger text-center">
                        Your free trial has ended. Please subscribe to continue using the service.
                    </div>
                    @endif

                    @endif
                    @else
                    <div class="card shadow-sm">
                        <div class="card-header bg-white text-center">
                            <h4>Start Your Free Trial</h4>
                        </div>
                        <div class="card-body">
                            <form id="payment-form" action="{{ route('subscription.free-trial.process') }}" method="POST">
                                @csrf
                                <input type="hidden" name="plan" id="plan" value="{{ $userPlan->stripe_price_id}}"> <!-- Replace with your price ID -->


                                <!-- Phone Number (Read-Only) -->
                                <div class="mb-3">
                                    <label for="phone_number" class="form-label">Phone Number</label>
                                    <input id="phone_number" type="text" class="form-control" value="{{ $user->phone }}" required>
                                </div>

                                <!-- Email (Read-Only) -->
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input id="email" type="email" class="form-control" value="{{ $user->email }}" readonly>
                                </div>


                                <div class="mb-3">
                                    <label for="card-holder-name">Name on Card</label>
                                    <input type="text" name="name" id="card-holder-name" class="form-control" placeholder="Name on the card" required>
                                </div>

                                <div class="form-group">
                                    <label for="card-element">Card Details</label>
                                    <div id="card-element"></div>
                                </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3" id="card-button" data-secret="{{ auth()->user()->createSetupIntent()->client_secret }}">
                            Purchase
                        </button>
                        </form>
                    </div>
                    <div class="card-footer text-center text-muted">
                        <small>Card will be charged $12.99/mo after trial ends unless canceled.</small>
                    </div>
                </div>
                @endif


            </div>
        </div>
    </div>

    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            const stripe = Stripe('{{ env('STRIPE_KEY') }}');
            const elements = stripe.elements();
            const cardElement = elements.create('card', {
                hidePostalCode: true,
            });
            cardElement.mount('#card-element');

            $('#payment-form').on('submit', async function(e) {
                e.preventDefault();

                const cardButton = $('#card-button');
                const cardHolderName = $('#card-holder-name');
                const clientSecret = cardButton.data('secret');
                cardButton.prop('disabled', true);
                const {
                    setupIntent,
                    error
                } = await stripe.confirmCardSetup(
                    clientSecret, {
                        payment_method: {
                            card: cardElement,
                            billing_details: {
                                name: cardHolderName.val(),
                            },
                        },
                    }
                );

                if (error) {
                    alert('Payment failed: ' + error.message);
                    cardButton.prop('disabled', false);
                } else {
                    $('<input>').attr({
                        type: 'hidden',
                        name: 'token',
                        value: setupIntent.payment_method
                    }).appendTo('#payment-form');

                    $('#payment-form').off('submit').submit();
                }
            });
        });
    </script>
</x-app-layout>
