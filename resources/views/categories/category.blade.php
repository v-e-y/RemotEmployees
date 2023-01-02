@extends('index')

@section('main')
    <article>
        <h1>{{ $category->name }}</h1>
        <p class="text-muted alert alert-light">
            {{ $category->description }}
        </p>
        @if (isset($products) && $products->count())
            <section class="row g-2" role="list">
                @foreach ($products as $product)
                    <div class="col-6 col-md-4 col-lg-3" role="listitem">
                        <div class="card">
                            <div class="card-body">
                                <h3>
                                    {{ $product->name }}
                                </h3>
                                <p>
                                    {{ Str::limit( $product->description, 175 ) }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </section>
        @else
            <p class="h2 pt-4 pb-4">
                No products yet!
            </p>
        @endif
    </article>
@endsection