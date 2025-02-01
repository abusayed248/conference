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
                        <form method="POST" action="{{ route('subscription.free-trial.process') }}">
                            @csrf

                            <!-- Phone Number (Read-Only) -->
                            <div class="mb-3">
                                <label for="phone_number" class="form-label">Phone Number</label>
                                <input id="phone_number" type="text" class="form-control" value="{{ $user->number }}" required>
                            </div>

                            <!-- Email (Read-Only) -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input id="email" type="email" class="form-control" value="{{ $user->email }}" readonly>
                            </div>

                            <!-- Card Number -->
                            <div class="mb-3">
                                <label for="card_number" class="form-label">Card Number</label>
                                <input id="card_number" type="text" name="card_number" class="form-control" placeholder="Enter your card number" required>
                                @error('card_number')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Expiry Date and CCV -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="expiry_date" class="form-label">Expiry Date</label>
                                    <input id="expiry_date" type="text" name="expiry_date" class="form-control" placeholder="MM/YY" required>
                                    @error('expiry_date')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="ccv" class="form-label">CCV</label>
                                    <input id="ccv" type="text" name="ccv" class="form-control" placeholder="CCV" required>
                                    @error('ccv')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-success w-100">Start 7-Day Free Trial</button>
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

</x-app-layout>
