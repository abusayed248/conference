<x-app-layout>

    <div class="mt-5">
        <div class="container">
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

            <div id="subscriber-management">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="h3"><a class="text-decoration" href="{{ url('/') }}">Go Back</a></h3>
                    </div>
                    <div class="col-md-6 text-right">
                        <h3 class="h3">Total Subscribers: @{{ totalSubscribers }}</h3>
                    </div>
                </div>

                <div class="row sub-menu">
                    <div class="col-md-5 my-0">
                        <h3 class="h3">Subscriber Management</h3>

                        <div class="sub-card">
                            <form action="{{ route('userPlan.update', $userPlan->id) }}" method="POST">
                                @csrf
                                <h3>
                                    Monthly Fee ($):
                                    <input type="number" name="monthly_fee" value="{{ $userPlan->monthly_fee }}" class="border" required />
                                </h3>
                                <h3>
                                    Free Trial (days):
                                    <input type="number" name="free_trial" value="{{ $userPlan->free_trial }}" class="border" required />
                                </h3>
                                <h3>
                                    <button type="submit">Save Changes</button>
                                </h3>
                            </form>
                        </div>
                    </div>

                    <div class="col-md-7 py-5">
                        <div class="search mb-4">
                            <input type="search" v-model="searchQuery" @input="searchSubscribers" class="form-control" placeholder="Search subscribers">
                        </div>
                        <div class="row">
                            <div v-for="subscriber in subscribers" :key="subscriber.id" class="col-md-6 mb-4">
                                <div class="sub-list-card">
                                    <h2>@{{ subscriber.name }}</h2>
                                    <h3>@{{ subscriber.email }}</h3>
                                    <h4>@{{ subscriber.phone }}</h4>
                                    <h4>@{{ subscriber.status }}</h4>
                                    <button @click="openSubscriberModal(subscriber)">More Info</button>/ <button @click="openEditModal(subscriber)">Edit</button>

                                </div>
                            </div>
                        </div>
                        <button v-if="hasMore" @click="loadMore" class="btn btn-primary w-100 mt-4">Load More</button>
                    </div>
                </div>

                <div class="modal fade" id="subscriberModal" tabindex="-1" aria-labelledby="subscriberModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="subscriberModalLabel">Subscriber Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div v-if="selectedSubscriber">
                                    <img :src="selectedSubscriber.photo" class="img-fluid mb-3" alt="User Photo" v-if="selectedSubscriber.photo">
                                    <p><strong>Name:</strong> @{{ selectedSubscriber.name }}</p>
                                    <p><strong>Email:</strong> @{{ selectedSubscriber.email }}</p>
                                    <p><strong>Phone:</strong> @{{ selectedSubscriber.phone }}</p>

                                    <p v-if="isFreeTrialActive(selectedSubscriber)">
                                        <strong>Status:</strong> 🟢 Free Trial Active
                                    </p>
                                    <p v-else-if="isActiveSubscriber(selectedSubscriber)">
                                        <strong>Status:</strong> ✅ Active Subscriber
                                        <br>
                                        <strong>Payment End Date:</strong> @{{ selectedSubscriber.payment_end }}
                                        <br>
                                        <strong>Last Payment Date:</strong> @{{ selectedSubscriber.payment_date }}
                                    </p>
                                    </p>
                                    <p v-else>
                                        <strong>Status:</strong> ❌ Subscription Expired <br>
                                        <strong>Payment End Date:</strong> @{{ selectedSubscriber.payment_end }}
                                        <br>
                                        <strong>Last Payment Date:</strong> @{{ selectedSubscriber.payment_date }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="editSubscriberModal" tabindex="-1" aria-labelledby="editSubscriberModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editSubscriberModalLabel">Edit Subscriber</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form @submit.prevent="updateSubscriber">
                                    <div class="mb-3">
                                        <label for="editEmail" class="form-label">Email</label>
                                        <input type="email" v-model="editSubscriber.email" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="editEmail" class="form-label">Phone</label>
                                        <input type="input" v-model="editSubscriber.phone" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="editPassword" class="form-label">New Password</label>
                                        <input type="password" v-model="editSubscriber.password" class="form-control">
                                        <small class="text-muted">Leave blank to keep the current password.</small>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        new Vue({
            el: '#subscriber-management',
            data: {
                subscribers: [],
                page: 1,
                perPage: 20,
                hasMore: true,
                searchQuery: '',
                totalSubscribers: 0,
                selectedSubscriber: null,
                editSubscriber: {
                    id: null,
                    email: '',
                    phone: '',
                    password: ''
                },
            },
            methods: {
                fetchSubscribers() {
                    axios
                        .get(`/subscribers`, {
                            params: {
                                page: this.page,
                                per_page: this.perPage,
                                search: this.searchQuery
                            }
                        })
                        .then((response) => {
                            // Ensure unique data before appending
                            let newSubscribers = response.data.data.filter(
                                sub => !this.subscribers.some(existing => existing.id === sub.id)
                            );

                            this.subscribers = [...this.subscribers, ...newSubscribers];
                            this.hasMore = response.data.next_page_url !== null;
                            this.totalSubscribers = response.data.total;
                            this.page++;
                        })
                        .catch((error) => {
                            console.error(error);
                        });
                },
                isFreeTrialActive(subscriber) {
                    if (!subscriber.free_trial) return false; // No free trial info available
                    let today = new Date();
                    let freeTrialEnd = new Date(subscriber.free_trial);
                    return today <= freeTrialEnd; // Returns true if trial is still active
                },

                openEditModal(subscriber) {
                    this.editSubscriber = {
                        id: subscriber.id,
                        email: subscriber.email,
                        phone: subscriber.phone,
                        password: ''
                    };
                    var modal = new bootstrap.Modal(document.getElementById('editSubscriberModal'));
                    modal.show();
                },

                updateSubscriber() {
                    axios
                        .post(`/update-subscription-user/${this.editSubscriber.id}`, {
                            email: this.editSubscriber.email,
                            phone: this.editSubscriber.phone,
                            password: this.editSubscriber.password
                        })
                        .then(response => {

                            alert(response.data.message);
                            var modal = bootstrap.Modal.getInstance(document.getElementById('editSubscriberModal'));
                            modal.hide();
                            this.page = 1;
                            this.subscribers = [];
                            this.fetchSubscribers();
                        })
                        .catch(error => {
                            console.error(error);
                        });
                },

                loadMore() {
                    this.fetchSubscribers();
                },

                searchSubscribers() {
                    this.page = 1;
                    this.subscribers = []; // Clear existing data
                    this.hasMore = true; // Reset pagination flag
                    this.fetchSubscribers();
                },

                openSubscriberModal(subscriber) {
                    this.selectedSubscriber = subscriber;
                    console.log(this.selectedSubscriber, 'this.selectedSubscriber');
                    var modal = new bootstrap.Modal(document.getElementById('subscriberModal'));
                    modal.show();
                },
                isActiveSubscriber(subscriber) {
                    if (!subscriber) return false;
                    const today = new Date();
                    const paymentEnd = subscriber.payment_end ? new Date(subscriber.payment_end) : null;
                    return subscriber.payment_done && paymentEnd && today < paymentEnd;
                },
            },
            mounted() {
                this.fetchSubscribers();
            },
        });
    </script>

</x-app-layout>
