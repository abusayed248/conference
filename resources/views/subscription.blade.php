<x-app-layout>

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


</x-app-layout>