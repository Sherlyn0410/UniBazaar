<x-app-layout>
    <div class="bg-white">
        <div class="container py-4">
            <div class="mb-4">
                <h3 class="text-left">Category</h3>
            </div>
            <div class="overflow-auto">
                <div class="d-flex flex-row">
                    <!-- Categories -->
                    <div class="text-center me-5">
                        <div class="">
                            <img src="{{ asset('assets/img/laptop.jpg') }}" alt="Category 1" class="rounded-circle object-fit-cover border border-1" style="width: 150px; height: 150px;">
                        </div>
                        <div class="mt-2">Laptops & Notebooks</div>
                    </div>
                    <div class="text-center me-5">
                        <div class="">
                            <img src="{{asset('assets/img/accessory.jpeg')}}" alt="Category 2" class="rounded-circle object-fit-cover border border-1" style="width: 150px; height: 150px;">
                        </div>
                        <div class="mt-2">Accessories</div>
                    </div>
                    <div class="text-center me-5">
                        <div class="">
                            <img src="{{asset('assets/img/tablet.jpg')}}" alt="Category 3" class="rounded-circle object-fit-cover border border-1" style="width: 150px; height: 150px;">
                        </div>
                        <div class="mt-2">Tablets</div>
                    </div>
                    <div class="text-center me-5">
                        <div class="">
                            <img src="{{asset('assets/img/mobile.jpg')}}" alt="Category 4" class="rounded-circle object-fit-cover border border-1" style="width: 150px; height: 150px;">
                        </div>
                        <div class="mt-2">Mobile Phones</div>
                    </div>
                    <div class="text-center me-5">
                        <div class="">
                            <img src="{{asset('assets/img/video.jpg')}}" alt="Category 6" class="rounded-circle object-fit-cover border border-1" style="width: 150px; height: 150px;">
                        </div>
                        <div class="mt-2">Video Game Consoles</div>
                    </div>
                    <div class="text-center me-5">
                        <div class="">
                            <img src="{{asset('assets/img/study.jpg')}}" alt="Category 5" class="rounded-circle object-fit-cover border border-1" style="width: 150px; height: 150px;">
                        </div>
                        <div class="mt-2">Study Materials</div>
                    </div>
                    <div class="text-center me-5">
                        <div class="">
                            <img src="{{asset('assets/img/sta.jpg')}}" alt="Category 7" class="rounded-circle object-fit-cover border border-1" style="width: 150px; height: 150px;">
                        </div>
                        <div class="mt-2">Stationeries</div>
                    </div>
                </div>
            </div>
        </div>

            @if(request()->has('query') && !empty($query))
    <div class="container py-4">
        <h3>Search results for "{{ $query }}"</h3>
        
        @if($results->count())
            <ul>
                @foreach($results as $product)
                    <li>{{ $product->product_name }}</li>
                @endforeach
            </ul>
        @else
            <p>No results found.</p>
        @endif
    </div>
@endif
        <!-- Show all product listings -->
        <div class="container py-4">
            <div class="mb-4">
                <h3 class="text-left">All Products</h3>
            </div>
            <div class="overflow-auto">
                <div class="d-flex flex-row">
                    @foreach ($products->shuffle() as $product)
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
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    
</x-app-layout>