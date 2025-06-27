
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
