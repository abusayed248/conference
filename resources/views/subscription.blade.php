<x-app-layout>

    <div id="subscription-bg">
        <div class="container py-5">
            <div class="text-center pricing-header">
                <h1 class="fw-bold">Subscription Plan</h1>
                <p class="text-muted">Choose a plan that fits your needs and grow with us.</p>
            </div>

            <div class="row justify-content-center">

                <!-- Premium Plan -->
                <div class="col-md-4">
                    <div class="card card-pricing text-center shadow-sm">
                        <div class="card-header">Premium</div>
                        <div class="card-body">
                            <p class="price" id="premiumPrice">$12.99<span class="price-period">/mo</span></p>
                            <ul class="list-unstyled features-list">
                                <li>1 Month</li>
                                <li>video/Audio Calling Oppertunity</li>
                                <li>24/7 Support</li>
                            </ul>
                            <button class="btn btn-subscribe w-100 mt-3">Subscribe</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            const stripe = Stripe('{{ env('
                STRIPE_KEY ') }}');
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