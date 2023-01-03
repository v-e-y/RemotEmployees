@extends('index')

@section('main')
    <article>
        <h1>{{ $category->name }}</h1>
        <p class="text-muted alert alert-light">
            {{ $category->description }}<br>
            <a href="{{ route('category.edit', [$category->id])}}" class="small">
                Edit
            </a>, 
            <a href="{{ route('category.destroy', [$category->id])}}" class="small">
                Delete
            </a>
        </p>
        @include('products.list')
    </article>
@endsection