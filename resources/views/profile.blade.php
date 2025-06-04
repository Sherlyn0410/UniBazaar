<x-app-layout>
    <div class="container mt-5">
        <div class="bg-danger rounded-top" style="height: 150px; background: linear-gradient(to right, #ff7c7c, #ffbaba); position: relative;"></div>

        <div class="bg-white p-4 rounded-bottom shadow" style="margin-top: -75px;">
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="d-flex align-items-center">
                    <img src="{{ $user->profile_image ? asset('storage/profile_images/' . $user->profile_image) : 'https://cdn-icons-png.flaticon.com/512/147/147144.png' }}"
                         alt="Profile" class="rounded-circle border border-white"
                         style="width: 120px; height: 120px; margin-top: -60px; object-fit: cover;">
                    <div class="ms-4">
                        <h4 class="mb-0">{{ $user->name }}</h4>
                        <small class="text-muted">Verified</small>
                    </div>
                    <div class="ms-auto">
                        <input type="file" name="profile_image" class="form-control" style="max-width: 200px;">
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-3">
                        <ul class="nav flex-column">
                            <li class="nav-item"><a class="nav-link active fw-bold" href="#">Profile</a></li>
                            <li class="nav-item"><a class="nav-link text-dark" href="#">Listings</a></li>
                            <li class="nav-item"><a class="nav-link text-dark" href="#">Insights</a></li>
                            <li class="nav-item"><a class="nav-link text-dark" href="#">Review</a></li>
                            <li class="nav-item"><a class="nav-link text-dark" href="#">Order History</a></li>
                        </ul>
                    </div>

                    <div class="col-md-9">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5>Profile Information</h5>
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="bi bi-pencil"></i> Save Changes
                            </button>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Name</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Email Address</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Phone No.</label>
                                <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            @if (session('status'))
                <div class="alert alert-success mt-4">
                    {{ session('status') }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>




