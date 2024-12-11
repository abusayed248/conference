<x-app-layout>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        You will be charged $12 for Plan
                    </div>

                    <div class="card-body">
                        <form id="payment-form" action="{{ route('subscription.create') }}" method="POST">
                            @csrf
                            <input type="hidden" name="plan" id="plan" value="price_1QUjDHKpSAQYC19tXIoTHd4L"> <!-- Replace with your price ID -->

                            <div class="form-group">
                                <label for="card-holder-name">Name on Card</label>
                                <input type="text" name="name" id="card-holder-name" class="form-control" placeholder="Name on the card" required>
                            </div>

                            <div class="form-group">
                                <label for="card-element">Card Details</label>
                                <div id="card-element"></div>
                            </div>
  
                            <button type="submit" class="btn btn-primary mt-3" id="card-button" data-secret="{{ auth()->user()->createSetupIntent()->client_secret }}">
                                Purchase
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            const stripe = Stripe('{{ env('STRIPE_KEY') }}');
            const elements = stripe.elements();
            const cardElement = elements.create('card', {
                hidePostalCode: true,
            });
            cardElement.mount('#card-element');

            $('#payment-form').on('submit', async function (e) {
                e.preventDefault();

                const cardButton = $('#card-button');
                const cardHolderName = $('#card-holder-name');
                const clientSecret = cardButton.data('secret');

                cardButton.prop('disabled', true);

                const { setupIntent, error } = await stripe.confirmCardSetup(
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
                    // Add setupIntent.payment_method as a hidden input and submit the form
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
