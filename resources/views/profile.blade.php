<x-app-layout>
    <div class="bg-danger" style="height: 180px; background: linear-gradient(to right, #ff7c7c, #ffbaba); position: relative;"></div>

    <div class="container mt-0 px-4" style="margin-top: -80px;">
        <div class="d-flex flex-wrap align-items-center">
            <div class="me-4 mb-3">
                <img src="{{ $user->profile_image ? asset('storage/profile_images/' . $user->profile_image) : 'https://cdn-icons-png.flaticon.com/512/147/147144.png' }}"
                     alt="Profile"
                     class="rounded-circle border border-white shadow"
                     style="width: 130px; height: 130px; object-fit: cover;">
            </div>

            <div class="me-auto mb-3">
                <h4 class="mb-1">{{ $user->name }}</h4>
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

        <div class="row mt-4">
            <!-- Sidebar -->
            <div class="col-md-3 border-end">
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a class="nav-link active fw-bold text-danger" href="#" data-target="profile-form">👤 Profile</a></li>
                    <li class="nav-item mb-2"><a class="nav-link text-dark" href="#" data-target="listings-section">📦 Listings</a></li>
                    <li class="nav-item mb-2"><a class="nav-link text-dark" href="#" data-target="insights-section">📊 Insights</a></li>
                    <li class="nav-item mb-2"><a class="nav-link text-dark" href="#" data-target="reviews-section">📝 Review</a></li>
                    <li class="nav-item mb-2"><a class="nav-link text-dark" href="#" data-target="orders-section">🕘 Order History</a></li>
                </ul>
            </div>

            <!-- Content Area -->
            <div class="col-md-9">
                <!-- Profile Form Section -->
                <div id="profile-form" class="content-section">
                    <form id="profileForm" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="fw-semibold">Profile Information</h5>
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="bi bi-pencil-square"></i> Save Changes
                            </button>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Name</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" readonly>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" readonly>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Phone</label>
                                <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}" readonly>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Other Tab Sections -->
                <div id="listings-section" class="content-section" style="display: none;">@include('listings')</div>
                <div id="insights-section" class="content-section" style="display: none;">@include('insights')</div>
                <div id="reviews-section" class="content-section" style="display: none;">@include('reviews')</div>
                <div id="orders-section" class="content-section" style="display: none;">@include('orders')</div>
            </div>
        </div>

        <!-- Flash Messages -->
        @if (session('status'))
            <div class="alert alert-success mt-4">{{ session('status') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger mt-3">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const navLinks = document.querySelectorAll('.nav-link');
            navLinks.forEach(link => {
                link.addEventListener('click', function (e) {
                    e.preventDefault();
                    navLinks.forEach(l => l.classList.remove('active', 'fw-bold', 'text-danger'));
                    navLinks.forEach(l => l.classList.add('text-dark'));
                    this.classList.add('active', 'fw-bold', 'text-danger');
                    this.classList.remove('text-dark');
                    document.querySelectorAll('.content-section').forEach(section => section.style.display = 'none');
                    document.getElementById(this.dataset.target).style.display = 'block';
                });
            });
            document.getElementById('profile-form').style.display = 'block';

            // 🔄 Preview uploaded profile picture
            document.getElementById('profile_image').addEventListener('change', function (e) {
                const [file] = e.target.files;
                if (file) {
                    document.querySelector('img[alt="Profile"]').src = URL.createObjectURL(file);
                }
            });
        });
    </script>

    <style>
        .nav-link { transition: all 0.3s ease; }
        .nav-link:hover { background-color: #f8f9fa; border-radius: 4px; }
        .content-section { animation: fadeIn 0.3s ease; }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
    </style>
</x-app-layout>





