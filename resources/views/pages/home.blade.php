@extends('index')

@section('main')
    @if (isset($products) && count($products))
        @foreach ($products as $product)
            {{ $product->name }}<br>
        @endforeach
    @endif
@endsection