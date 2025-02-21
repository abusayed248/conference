<x-app-layout>
    @if($hasSubscription)
    <style>
        .subscription-box {
            max-width: 350px;
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-custom {
            width: 100%;
            margin-top: 10px;
            font-weight: bold;
            background-color: #3D0BDA;
            color: white;
        }

        .btn-custom:hover {
            background-color: #240c75;
            color: #ffffff
        }

        .active-status {
            font-size: 18px;
            font-weight: bold;
        }

        .active-status span {
            color: green;
        }

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #fff;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 50%;
            max-width: 500px;
            border-radius: 10px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover {
            color: #000;
        }

        /* Card element styles */
        #card-element {
            margin: 20px 0;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>

    <div class="mt-5">
        <div class="d-flex justify-content-center align-items-center vh-10">
            <div class="subscription-box text-center">
                <!-- Display renewal date -->
                <p class="active-status">Plan active <span>🟢</span></p>
                <p><small>Renews: {{ \Carbon\Carbon::parse($user->payment_end)->format('m/d/Y') }}</small></p>

                <!-- Buttons -->
                <button class="btn btn-custom" onclick="openPhoneModal()">Change phone number</button>
                <button class="btn btn-custom" onclick="openPaymentMethodModal()">Change payment method</button>
                <button class="btn btn-custom mt-3" onclick="cancelSubscription()">Cancel plan renewal</button>
            </div>
        </div>
    </div>

    <!-- Phone Number Change Modal -->
    <div id="changePhoneModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closePhoneModal()">&times;</span>

            <form id="phone-form">
                <!-- Phone Number Input with Country Code -->
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="tel" id="phone" class="form-control" placeholder="Enter phone number" required>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-custom mt-3">Update Phone Number</button>
            </form>
        </div>
    </div>

    <!-- Payment Method Modal -->
    <div id="paymentMethodModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closePaymentMethodModal()">&times;</span>
            <h3>Change Payment Method</h3>
            <form id="payment-form">
                <div id="card-element"></div>
                <button id="submit-button" class="btn btn-custom mt-3">Update Card</button>
            </form>
        </div>
    </div>
    @else

    <div id="subscription-bg">
        <div class="container py-5">
            <div class="text-center pricing-header">
                <h1 class="fw-bold">Subscription Plan</h1>
            </div>

            <div class="row justify-content-center">
                <!-- Premium Plan -->
                <div class="col-md-4">
                    <div class="card card-pricing text-center shadow-sm">
                        <div class="card-header">Premium</div>
                        <div class="card-body">
                            <p class="price" id="premiumPrice">${{ $userPlan->monthly_fee}}<span class="price-period">/mo</span></p>
                            <ul class="list-unstyled features-list">
                                <li>1 Month</li>
                                <li>24/7 Support</li>
                            </ul>
                            <form action="{{ route('payment.page') }}" method="GET">
                                <button type="submit" class="btn btn-subscribe w-100 mt-3">Subscribe</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endif

    <!-- Include intl-tel-input Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"></script>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        // Initialize Stripe
        const stripe = Stripe('{{ env("STRIPE_KEY") }}');
        const elements = stripe.elements();
        const cardElement = elements.create('card', {
            hidePostalCode: true,
        });

        cardElement.mount('#card-element');

        // Open the payment method modal
        function openPaymentMethodModal() {
            document.getElementById('paymentMethodModal').style.display = 'block';
        }

        // Close the payment method modal
        function closePaymentMethodModal() {
            document.getElementById('paymentMethodModal').style.display = 'none';
        }

        // Handle form submission
        const form = document.getElementById('payment-form');
        form.addEventListener('submit', async (event) => {
            event.preventDefault();

            const {
                paymentMethod,
                error
            } = await stripe.createPaymentMethod({
                type: 'card',
                card: cardElement,
            });

            if (error) {
                alert('Error updating card details.');
            } else {
                // Send the payment method ID to your server
                fetch('/update-payment-method', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        },
                        body: JSON.stringify({
                            token: paymentMethod.id
                        }),
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Card updated successfully!');
                            closePaymentMethodModal();
                        } else {
                            alert('Failed to update card.');
                        }
                    });
            }
        });

        // Handle subscription cancellation
        function cancelSubscription() {
            if (confirm('Are you sure you want to cancel auto-renewal? Your subscription will remain active until the end of the current billing period.')) {
                fetch('/cancel-subscription', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Subscription auto-renewal canceled successfully.');
                            window.location.reload(); // Refresh the page to update the UI
                        } else {
                            alert('Failed to cancel auto-renewal.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while canceling auto-renewal.');
                    });
            } else {
                alert('Auto-renewal cancellation canceled.');
            }
        }

        // Open the phone number change modal
        function openPhoneModal() {
            document.getElementById('changePhoneModal').style.display = 'block';
        }

        // Close the phone number change modal
        function closePhoneModal() {
            document.getElementById('changePhoneModal').style.display = 'none';
        }

        // Initialize intl-tel-input
        document.addEventListener("DOMContentLoaded", function() {
            const phoneInput = document.querySelector("#phone");
            const iti = window.intlTelInput(phoneInput, {
                initialCountry: "auto", // Auto-detect country
                geoIpLookup: function(callback) {
                    fetch('https://ipapi.co/json')
                        .then(response => response.json())
                        .then(data => callback(data.country_code.toLowerCase()))
                        .catch(() => callback("us")); // Default to US if lookup fails
                },
                separateDialCode: true, // Show country code separately
                utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
            });

            // Handle phone number form submission
            const phoneForm = document.getElementById('phone-form');
            phoneForm.addEventListener('submit', async (event) => {
                event.preventDefault();

                // Get the full phone number with country code
                const fullPhoneNumber = iti.getNumber();

                if (!iti.isValidNumber()) {
                    alert('Please enter a valid phone number.');
                    return;
                }

                // Send the new phone number to your server
                fetch('/update-phone-number', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        },
                        body: JSON.stringify({
                            phone_number: fullPhoneNumber
                        }),
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Phone number updated successfully!');
                            closePhoneModal();
                            window.location.reload(); // Refresh the page to update the UI
                        } else {
                            alert('Failed to update phone number.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while updating the phone number.');
                    });
            });
        });
    </script>
</x-app-layout>
