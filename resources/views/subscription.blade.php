<x-app-layout>

    <div id="subscription-bg">
        <div class="container py-5">
            <div class="text-center pricing-header">
                <h1 class="fw-bold">Modern Subscription Plans</h1>
                <p class="text-muted">Choose a plan that fits your needs and grow with us.</p>
                <div class="form-check form-switch d-inline-block">
                    <label class="form-check-label me-2" for="billingToggle">Monthly</label>
                    <input class="form-check-input" type="checkbox" id="billingToggle">
                    <label class="form-check-label ms-2" for="billingToggle">Yearly</label>
                </div>
            </div>

            <div class="row justify-content-center">
                <!-- Basic Plan -->
                <div class="col-md-4">
                    <div class="card card-pricing text-center shadow-sm">
                        <div class="card-header">Basic</div>
                        <div class="card-body">
                            <p class="price" id="basicPrice">$10<span class="price-period">/month</span></p>
                            <ul class="list-unstyled features-list">
                                <li>1 User</li>
                                <li>10GB Storage</li>
                                <li>Email Support</li>
                            </ul>
                            <button class="btn btn-subscribe w-100 mt-3">Subscribe</button>
                        </div>
                    </div>
                </div>

                <!-- Standard Plan (Highlighted) -->
                <div class="col-md-4">
                    <div class="card card-pricing text-center shadow-sm highlight">
                        <div class="card-header">Standard</div>
                        <div class="card-body">
                            <p class="price" id="standardPrice">$20<span class="price-period">/month</span></p>
                            <ul class="list-unstyled features-list">
                                <li>5 Users</li>
                                <li>50GB Storage</li>
                                <li>Priority Support</li>
                            </ul>
                            <button class="btn btn-subscribe w-100 mt-3">Subscribe</button>
                        </div>
                    </div>
                </div>

                <!-- Premium Plan -->
                <div class="col-md-4">
                    <div class="card card-pricing text-center shadow-sm">
                        <div class="card-header">Premium</div>
                        <div class="card-body">
                            <p class="price" id="premiumPrice">$50<span class="price-period">/month</span></p>
                            <ul class="list-unstyled features-list">
                                <li>Unlimited Users</li>
                                <li>200GB Storage</li>
                                <li>24/7 Support</li>
                            </ul>
                            <button class="btn btn-subscribe w-100 mt-3">Subscribe</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle pricing between monthly and yearly
        document.getElementById('billingToggle').addEventListener('change', function () {
            const isYearly = this.checked;

            document.getElementById('basicPrice').innerHTML = isYearly
                ? '$100<span class="price-period">/year</span>'
                : '$10<span class="price-period">/month</span>';
            document.getElementById('standardPrice').innerHTML = isYearly
                ? '$200<span class="price-period">/year</span>'
                : '$20<span class="price-period">/month</span>';
            document.getElementById('premiumPrice').innerHTML = isYearly
                ? '$500<span class="price-period">/year</span>'
                : '$50<span class="price-period">/month</span>';
        });
    </script>
  
  
  
  </x-app-layout>