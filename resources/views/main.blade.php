<x-app-layout>
    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="assets/img/slide1.png" class="d-block w-100" alt="welcome">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div class="bg-white">
        <div class="container py-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="text-left">From Your Campus Mates</h3>
                <a href="{{ route('marketplace') }}" class="link-secondary link-underline-opacity-0">Show All<i class="bi bi-chevron-right ms-1"></i></a>
            </div>
            <div class="overflow-auto">
                <div class="d-flex flex-row">
                    @forelse ($products->shuffle() as $product)
                        <a href="{{ route('product.show', $product->id) }}" class="text-decoration-none text-dark me-3">
                            <div style="width: 200px;">
                                <img src="{{ asset($product->product_image) }}" class="card-img-top object-fit-cover border rounded mb-1" alt="{{ $product->product_name }}" style="height: 200px;" />
                                <div class="card-body">
                                    <h5 class="card-title text-truncate">{{ $product->product_name }}</h5>
                                    <h6 class="card-text">RM{{ $product->product_price }}</h6>
                                    <p class="text-truncate">
                                        <span class="badge rounded-pill text-bg-warning text-white">4.7<i class="bi bi-star-fill ms-1"></i></span>
                                        {{ $product->student->name }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="text-center py-5 text-muted fs-4 w-100">
                            <i class="bi bi-emoji-frown mb-2" style="font-size:2rem;"></i><br>
                            No product found.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="container pb-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="text-left">Recently Added Items</h3>
                <a href="{{ route('marketplace') }}" class="link-secondary link-underline-opacity-0">Show All<i class="bi bi-chevron-right ms-1"></i></a>
            </div>
            <div class="overflow-auto">
                <div class="d-flex flex-row">
                    @forelse ($products as $product)
                        <a href="{{ route('product.show', $product->id) }}" class="text-decoration-none text-dark me-3">
                            <div style="width: 200px;">
                                <img src="{{ asset($product->product_image) }}" class="card-img-top object-fit-cover border rounded mb-1" alt="{{ $product->product_name }}" style="height: 200px;" />
                                <div class="card-body">
                                    <h5 class="card-title text-truncate">{{ $product->product_name }}</h5>
                                    <h6 class="card-text">RM{{ $product->product_price }}</h6>
                                    <p class="text-truncate">
                                        <span class="badge rounded-pill text-bg-warning text-white">4.7<i class="bi bi-star-fill ms-1"></i></span>
                                        {{ $product->student->name }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="text-center py-5 text-muted fs-4 w-100">
                            <i class="bi bi-emoji-frown mb-2" style="font-size:2rem;"></i><br>
                            No product found.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
