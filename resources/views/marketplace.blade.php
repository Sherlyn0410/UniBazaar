<x-app-layout>
   <div class="bg-white">
    <div class="container py-4">
        <div class="mb-4">
            <h3 class="text-left">Category</h3>
        </div>
        <div class="overflow-auto">
            <div class="d-flex flex-row">
                <!-- Laptops & Notebooks -->
                <a href="{{ route('category.filter', ['category' => 'laptop']) }}" class="text-decoration-none text-dark text-center me-5">
                    <div>
                        <img src="{{ asset('assets/img/laptop.jpg') }}" alt="Laptops" class="rounded-circle object-fit-cover border border-1" style="width: 150px; height: 150px;">
                        <div class="mt-2">Laptops & Notebooks</div>
                    </div>
                </a>

                <!-- Accessories -->
                <a href="{{ route('category.filter', ['category' => 'accessories']) }}" class="text-decoration-none text-dark text-center me-5">
                    <div>
                        <img src="{{ asset('assets/img/accessory.jpeg') }}" alt="Accessories" class="rounded-circle object-fit-cover border border-1" style="width: 150px; height: 150px;">
                        <div class="mt-2">Accessories</div>
                    </div>
                </a>

                <!-- Tablets -->
                <a href="{{ route('category.filter', ['category' => 'tablets']) }}" class="text-decoration-none text-dark text-center me-5">
                    <div>
                        <img src="{{ asset('assets/img/tablet.jpg') }}" alt="Tablets" class="rounded-circle object-fit-cover border border-1" style="width: 150px; height: 150px;">
                        <div class="mt-2">Tablets</div>
                    </div>
                </a>

                <!-- Mobile Phones -->
                <a href="{{ route('category.filter', ['category' => 'mobile-phone']) }}" class="text-decoration-none text-dark text-center me-5">
                    <div>
                        <img src="{{ asset('assets/img/mobile.jpg') }}" alt="Mobile Phones" class="rounded-circle object-fit-cover border border-1" style="width: 150px; height: 150px;">
                        <div class="mt-2">Mobile Phones</div>
                    </div>
                </a>

                <!-- Video Game Consoles -->
                <a href="{{ route('category.filter', ['category' => 'video-game']) }}" class="text-decoration-none text-dark text-center me-5">
                    <div>
                        <img src="{{ asset('assets/img/video.jpg') }}" alt="Video Games" class="rounded-circle object-fit-cover border border-1" style="width: 150px; height: 150px;">
                        <div class="mt-2">Video Game Consoles</div>
                    </div>
                </a>

                <!-- Study Materials -->
                <a href="{{ route('category.filter', ['category' => 'study-material']) }}" class="text-decoration-none text-dark text-center me-5">
                    <div>
                        <img src="{{ asset('assets/img/study.jpg') }}" alt="Study Materials" class="rounded-circle object-fit-cover border border-1" style="width: 150px; height: 150px;">
                        <div class="mt-2">Study Materials</div>
                    </div>
                </a>

                <!-- Stationeries -->
                <a href="{{ route('category.filter', ['category' => 'stationeries']) }}" class="text-decoration-none text-dark text-center me-5">
                    <div>
                        <img src="{{ asset('assets/img/sta.jpg') }}" alt="Stationeries" class="rounded-circle object-fit-cover border border-1" style="width: 150px; height: 150px;">
                        <div class="mt-2">Stationeries</div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>


        @if(request()->has('query') && !empty($query))
        <div class="container py-4">
            <h3 class="mb-4">Search results for "{{ $query }}"</h3>
            
            @if($results->count())
                <div class="row g-4">
                    @foreach($results as $product)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-2">
                        <a href="{{ route('product.show', $product->id) }}" class="text-decoration-none text-dark">
                            <div>
                                <img src="{{ asset($product->product_image) }}" class="card-img-top object-fit-cover border rounded mb-1" alt="{{ $product->product_name }}" style="height: 200px; width: 100%; object-fit: cover;" />
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
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-5 text-muted fs-4">
                    <i class="bi bi-emoji-frown mb-2" style="font-size:2rem;"></i><br>
                    No product found.
                </div>
            @endif
        </div>
        @endif

        <!-- Show all product listings -->
       <div class="container py-4">
    <div class="mb-4">
        <h3 class="text-left">All Products</h3>
    </div>
    @if($products->count())
        <div class="row g-4">
            @foreach($products->shuffle() as $product)
                <div class="col-12 col-sm-6 col-md-4 col-lg-2">
                    <a href="{{ route('product.show', $product->id) }}" class="text-decoration-none text-dark">
                        <div>
                            <img src="{{ asset('/assets/img/' . $product->product_image) }} " class="card-img-top object-fit-cover border rounded mb-1" alt="{{ $product->product_name }}" style="height: 200px; width: 100%; object-fit: cover;" />
                            <div class="card-body">
                                <h5 class="card-title text-truncate">{{ $product->product_name }}</h5>
                                <h6 class="card-text">RM{{ $product->product_price }}</h6>
                                <p class="text-truncate">
                                    @php
                                        $ratings = $product->student->receivedRatings;
                                        $average = $ratings->avg('rating');
                                    @endphp
                                    <span class="badge rounded-pill text-bg-warning text-white">
                                        {{ number_format($average ?? 0, 1) }}<i class="bi bi-star-fill ms-1"></i>
                                    </span>
                                    {{ $product->student->name }}
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-5 text-muted fs-4">
            <i class="bi bi-emoji-frown mb-2" style="font-size:2rem;"></i><br>
            No product found.
        </div>
    @endif
</div>

    
</x-app-layout>