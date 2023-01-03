@extends('index')

@section('main')
    <section class="col-12 col-md-8 col-lg-6">
        <article>
            <h1>
                {{ $product->name }}
            </h1>
            <p>
                Price - <span class="lead">{{ $product->price }}</span>
            </p>
            <p>
                Condition - {{ $product->condition->name }}
            </p>
            <p>
                {{ $product->description }}
            </p>
            @if (isset($product->categories) && $product->categories->count())
                <div class="small">
                    <ul class="list-inline">
                        <li class="list-inline-item">Categories:</li>
                        @foreach ($product->categories as $category)
                            <li class="list-inline-item">
                                <a 
                                    href="{{ route('category.showProducts', [$category->slug]) }}"
                                    title="{{ $category->name }} products"
                                >
                                    {{ $category->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </article>
        <aside class="pt-4 mt-4 border-top">
            <ul class="list-inline">
                <li class="list-inline-item">
                    <a 
                        href="{{ route('product.edit', [$product->id]) }}" 
                        title="edit - {{ $product->name }}"
                    >
                        Edit
                    </a>
                </li>
                <li class="list-inline-item">
                    <a 
                        href="{{ route('product.destroy', [$product->id]) }}" 
                        title="delete - {{ $product->name }}"
                    >
                        Delete
                    </a>
                </li>
            </ul>
        </aside>
    </section>
@endsection