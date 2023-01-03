@if (isset($products) && count($products))
    <section class="row g-2 pb-4" role="list">
        @foreach ($products as $product)
            <div class="col-6 col-md-4 col-lg-3" role="listitem">
                <a 
                    class="card text-body text-decoration-none"
                    href="{{ route('product.show', [$product->id]) }}"
                    title="{{ $product->name }}"
                >
                    <div class="card-body">
                        <h3>
                            {{ $product->name }}
                        </h3>
                        <p class="lead">
                            {{ $product->price }}
                        </p>
                        <p>
                            {{ Str::limit( $product->description, 175 ) }}
                        </p>
                        <p class="small mb-0 text-muted">
                            {{ date('d-m-Y | H:i', strtotime($product->created_at)) }}
                        </p>
                    </div>
                </a>
            </div>
        @endforeach
    </section>
    {{ $products->links() }}
@else
    <p class="h2 pt-4 pb-4">
        No products yet!
    </p>
@endif