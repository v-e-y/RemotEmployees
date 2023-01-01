@extends('index')

@section('main')
    <article class="col-12 col-md-8 col-lg-6">
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
    </article>
@endsection