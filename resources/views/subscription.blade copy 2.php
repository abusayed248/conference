<x-app-layout>
    <div id="subscription-bg">
        <div class="container py-5">
            <form id="subscription-form" action="{{ route('create.subscription') }}" method="POST">
                @csrf
                <input type="hidden" id="payment_method_id" name="payment_method_id">
                <div id="card-element"></div>
                <div id="card-errors" role="alert" class="text-danger"></div>
                <button id="subscribe-button" type="button" class="btn btn-primary mt-3">Subscribe</button>
            </form>
        </div>
    </div>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const stripe = Stripe("{{ env('STRIPE_KEY') }}"); // Use your Stripe public key
            const elements = stripe.elements();

            // Create a card element
            const card = elements.create('card');
            card.mount('#card-element');

            // Handle real-time validation errors from the card Element
            card.on('change', function (event) {
                const cardErrors = document.getElementById('card-errors');
                if (event.error) {
                    cardErrors.textContent = event.error.message;
                } else {
                    cardErrors.textContent = '';
                }
            });

            // Handle form submission
            const subscribeButton = document.getElementById('subscribe-button');
            const form = document.getElementById('subscription-form');

            subscribeButton.addEventListener('click', async function () {
                subscribeButton.disabled = true;

                const { error, paymentMethod } = await stripe.createPaymentMethod({
                    type: 'card',
                    card: card,
                });

                if (error) {
                    // Display error message
                    const cardErrors = document.getElementById('card-errors');
                    cardErrors.textContent = error.message;
                    subscribeButton.disabled = false;
                } else {
                    // Add payment method ID to form and submit
                    document.getElementById('payment_method_id').value = paymentMethod.id;
                    form.submit();
                }
            });
        });
    </script>
</x-app-layout>


@extends('layouts.app')
    
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    You will be charged ${{ number_format($plan->price, 2) }} for {{ $plan->name }} Plan
                </div>
  
                <div class="card-body">
  
                    <form id="payment-form" action="{{ route('subscription.create') }}" method="POST">
                        @csrf
                        <input type="hidden" name="plan" id="plan" value="{{ $plan->id }}">
  
                        <div class="row">
                            <div class="col-xl-4 col-lg-4">
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" name="name" id="card-holder-name" class="form-control" value="" placeholder="Name on the card">
                                </div>
                            </div>
                        </div>
  
                        <div class="row">
                            <div class="col-xl-4 col-lg-4">
                                <div class="form-group">
                                    <label for="">Card details</label>
                                    <div id="card-element"></div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12">
                            <hr>
                                <button type="submit" class="btn btn-primary" id="card-button" data-secret="{{ $intent->client_secret }}">Purchase</button>
                            </div>
                        </div>
  
                    </form>
  
                </div>
            </div>
        </div>
    </div>
</div>
  
<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe('{{ env('STRIPE_KEY') }}')
  
    const elements = stripe.elements()
    const cardElement = elements.create('card')
  
    cardElement.mount('#card-element')
  
    const form = document.getElementById('payment-form')
    const cardBtn = document.getElementById('card-button')
    const cardHolderName = document.getElementById('card-holder-name')
  
    form.addEventListener('submit', async (e) => {
        e.preventDefault()
  
        cardBtn.disabled = true
        const { setupIntent, error } = await stripe.confirmCardSetup(
            cardBtn.dataset.secret, {
                payment_method: {
                    card: cardElement,
                    billing_details: {
                        name: cardHolderName.value
                    }   
                }
            }
        )
  
        if(error) {
            cardBtn.disable = false
        } else {
            let token = document.createElement('input')
            token.setAttribute('type', 'hidden')
            token.setAttribute('name', 'token')
            token.setAttribute('value', setupIntent.payment_method)
            form.appendChild(token)
            form.submit();
        }
    })
</script>
@endsection