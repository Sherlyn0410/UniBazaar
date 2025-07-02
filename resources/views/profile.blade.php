<x-app-layout>
    <div class="container-fluid bg-white">
        <div class="container py-4">
            <div class="d-flex flex-wrap align-items-center">
                <div class="me-4 mb-3">
                    <img src="{{ $student->profile_image ? asset('storage/profile_images/' . $student->profile_image) : 'https://cdn-icons-png.flaticon.com/512/147/147144.png' }}"
                        alt="Profile"
                        class="rounded-circle border border-white shadow"
                        style="width: 130px; height: 130px; object-fit: cover;">
                </div>

                <div class="me-auto mb-3">
                    <h4 class="mb-1">{{ $student->name }}</h4>
                    <small class="text-muted">Verified User</small>
                    <div class="mt-2">
                        <label for="profile_image" class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-camera"></i> Change Picture
                        </label>
                        <input type="file" id="profile_image" name="profile_image" class="form-control d-none" form="profileForm">
                    </div>
                </div>

                <div class="mb-3">
                    <div class="border rounded bg-light px-4 py-3 text-center">
                        <h6 class="mb-1">⭐ Rating & Reviews</h6>
                        <p class="mb-0 fw-semibold">4.8 / 5</p>
                        <small class="text-muted">Based on 45 reviews</small>
                    </div>
                </div>
            </div>
            <hr>


            <div class="row mt-4">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert" id="rating-success">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                @endif

                <!-- Alert insights -->
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Sidebar -->
                <div class="d-flex align-items-start">
                    <div class="nav flex-column nav-pills col-2" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <button class="nav-link {{ request('tab', 'profile') === 'profile' ? 'active' : '' }}" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="{{ request('tab', 'profile') === 'profile' ? 'true' : 'false' }}">Profile</button>
                        <button class="nav-link {{ request('tab') === 'listings' ? 'active' : '' }}" id="v-pills-listings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-listings" type="button" role="tab" aria-controls="v-pills-listings" aria-selected="{{ request('tab') === 'listings' ? 'true' : 'false' }}">Listings</button>
                        <button class="nav-link {{ request('tab') === 'insights' ? 'active' : '' }}" id="v-pills-insights-tab" data-bs-toggle="pill" data-bs-target="#v-pills-insights" type="button" role="tab" aria-controls="v-pills-insights" aria-selected="{{ request('tab') === 'insights' ? 'true' : 'false' }}">Insights</button>
                        <button class="nav-link {{ request('tab') === 'review' ? 'active' : '' }}" id="v-pills-review-tab" data-bs-toggle="pill" data-bs-target="#v-pills-review" type="button" role="tab" aria-controls="v-pills-review" aria-selected="{{ request('tab') === 'review' ? 'true' : 'false' }}">Review</button>
                        <button class="nav-link {{ request('tab') === 'order' ? 'active' : '' }}" id="v-pills-order-tab" data-bs-toggle="pill" data-bs-target="#v-pills-order" type="button" role="tab" aria-controls="v-pills-order" aria-selected="{{ request('tab') === 'order' ? 'true' : 'false' }}">Purchase History</button>
                    </div>
                    <div class="tab-content col-10" id="v-pills-tabContent">
                        <!-- Profile -->
                        <div class="tab-pane fade {{ request('tab', 'profile') === 'profile' ? 'show active' : '' }}" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab" tabindex="0">
                            <form id="profileForm" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="fw-semibold">Profile Information</h5>
                                    <x-red-button>
                                        <i class="bi bi-pencil-square me-2"></i>{{ __('Save Changes') }}
                                    </x-red-button>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Name</label>
                                        <input type="text" name="name" class="form-control" value="{{ old('name', $student->name) }}" >
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Email</label>
                                        <input type="email" name="email" class="form-control" value="{{ old('email', $student->email) }}" readonly>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Phone</label>
                                        <input type="text" name="contact" class="form-control" value="{{ old('contact', $student->contact) }}" >
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- Listings -->
                        <div class="tab-pane fade {{ request('tab') === 'listings' ? 'show active' : '' }}" id="v-pills-listings" role="tabpanel" aria-labelledby="v-pills-listings-tab" tabindex="0">
                            @include('listings')
                        </div>
                        <!-- Insights -->
                        <div class="tab-pane fade {{ request('tab') === 'insights' ? 'show active' : '' }}" id="v-pills-insights" role="tabpanel" aria-labelledby="v-pills-insights-tab" tabindex="0">
                            @include('insights')
                        </div>
                        <!-- Review -->
                        <div class="tab-pane fade {{ request('tab') === 'review' ? 'show active' : '' }}" id="v-pills-review" role="tabpanel" aria-labelledby="v-pills-review-tab" tabindex="0">
                            @include('rating')
                        </div>
                        <!-- Order History -->
                        <div class="tab-pane fade {{ request('tab') === 'order' ? 'show active' : '' }}" id="v-pills-order" role="tabpanel" aria-labelledby="v-pills-order-tab" tabindex="0">
                            @include('orders')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .nav-pills .nav-link {
            color: #6c757d !important; /* Black text */
            background-color: transparent !important; /* No background */
        }
        .nav-pills .nav-link.active, 
        .nav-pills .show > .nav-link {
            font-weight: bold !important; /* Bold text */
            color: #000 !important; /* White text */
            background-color: none !important; /* Bootstrap secondary color */
        }
    </style>
</x-app-layout>





