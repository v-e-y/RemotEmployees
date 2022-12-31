@if (isset($products) && count($products))
    @foreach ($products as $product)
        {{ $product->name }}
    @endforeach
@endif