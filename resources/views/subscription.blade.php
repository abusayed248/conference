<x-app-layout>

    <div id="subscription-bg">
        <div class="container py-5">
            <div class="text-center pricing-header">
                <h1 class="fw-bold">Modern Subscription Plans</h1>
                <p class="text-muted">Choose a plan that fits your needs and grow with us.</p>
            </div>

            <div class="row justify-content-center">
                <!-- Basic Plan -->
                <div class="col-md-4">
                    <div class="card card-pricing text-center shadow-sm">
                        <div class="card-header">Basic</div>
                        <div class="card-body">
                            <p class="price" id="basicPrice">$10<span class="price-period">per/month</span></p>
                            <ul class="list-unstyled features-list">
                                <li>1 Month</li>
                                <li>Video/Audio Calling Oppertunity</li>
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
                            <p class="price" id="standardPrice">$30<span class="price-period">6/month</span></p>
                            <ul class="list-unstyled features-list">
                                <li>6 Month</li>
                                <li>Video/Audio Calling Oppertunity</li>
                                <li>24/7 Support</li>
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
                            <p class="price" id="premiumPrice">$50<span class="price-period">1/year</span></p>
                            <ul class="list-unstyled features-list">
                                <li>1 Year</li>
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
  
  
  </x-app-layout>