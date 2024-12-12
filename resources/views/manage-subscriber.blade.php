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
                  <h4>@{{ subscriber.payment_end }}</h4>
                  <a :href="'/subscriber/' + subscriber.id">More Info/Edit</a>
                </div>
              </div>
            </div>
            <button v-if="hasMore" @click="loadMore" class="btn btn-primary w-100 mt-4">Load More</button>
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
        perPage: 2,
        hasMore: true,
        searchQuery: '',
        totalSubscribers: 0,
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
              this.subscribers = [...this.subscribers, ...response.data.data];
              this.hasMore = response.data.next_page_url !== null;
              this.totalSubscribers = response.data.total;
              this.page++;
            })
            .catch((error) => {
              console.error(error);
            });
        },
        loadMore() {
          this.fetchSubscribers();
        },
        searchSubscribers() {
          this.page = 1;
          this.subscribers = [];
          this.fetchSubscribers();
        },
      },
      mounted() {
        this.fetchSubscribers();
      },
    });
  </script>

</x-app-layout>