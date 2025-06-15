<x-app-layout>
    <div class="container-fluid" style="min-height: 100vh;">
        <div class="container py-4">  
            <div class="row justify-content-center">
                <div class="col-lg-4 d-flex justify-content-center mb-4 mb-lg-0">
                    <a href="{{ route('marketplace') }}" class="fs-4 text-dark me-4">
                        <i class="bi bi-chevron-left"></i>
                    </a>
                    <img src="{{ asset($product->product_image) }}" class="border rounded-4 object-fit-cover w-100" alt="{{ $product->product_name }}" style="max-height: 420px;">
                </div>
                <div class="col-lg-8 d-flex flex-column justify-content-between">
                    <div class="ms-3">
                        <div class="mb-2 d-flex justify-content-between align-items-end">
                            <div>
                                <div class="fw-semibold fs-5">{{ $product->student->name }}</div>
                                <div class="text-warning fs-6">4.7 <i class="bi bi-star-fill ms-1 me-2"></i>(56 Reviews)</div>
                            </div>
                            <button class="btn btn-outline-secondary">
                                <i class="bi bi-chat-dots me-2"></i> Chat
                            </button>
                        </div>
                        <hr>
                        <h3 class="fw-semibold mb-2">{{ $product->product_name }}</h3>
                        <h4 class="fw-medium mb-2">RM{{ $product->product_price }}</h4>
                        
                        <h5 class="fw-semibold mb-2">Description</h5>
                        <p class="text-secondary">{{ $product->product_details }}</p>
                    </div>
                    <form method="POST" class="ms-4 d-flex align-items-center gap-3 flex-wrap">
                        @csrf
                        <x-red-outline-button>
                            <i class="bi bi-cart-plus me-2"></i>
                            {{ __('Add to Cart') }}
                        </x-red-outline-button>
                        <x-red-button type="button">
                            <i class="bi bi-bag-check me-2"></i> 
                            {{ __('Buy Now') }}
                        </x-red-button>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
</x-app-layout>
