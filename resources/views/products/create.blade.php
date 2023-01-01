@extends('index')

@section('main')
    <section class="col-12 col-md-9 col-lg-6">
        <article class="card">
            <form action="{{ route('product.store') }}" method="post" class="card-body">
                @csrf
                <fieldset>
                    <div class="mb-3">
                        <label for="name" class="form-label">Lot name</label>
                        <input 
                            type="text" 
                            class="form-control @error('name') is-invalid @enderror" 
                            value="{{ old('name') }}"
                            name="name" 
                            id="name"
                            required 
                            autofocus
                        >
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input 
                                type="number" 
                                step="0.01" 
                                class="form-control @error('price') is-invalid @enderror" 
                                value="{{ old('price') }}"
                                name="price" 
                                id="price"
                                required
                            >
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" cols="30" rows="10" class="form-control @error('description') is-invalid @enderror" required>{{ old('description') }}</textarea>
                    </div>
                    @if (isset($categories) && $categories->count())
                        <section class="row g-2">
                            <div class="col-12">
                                <p class="lead mb-0">
                                    Choose a categories:
                                </p>
                            </div>
                            @foreach ($categories as $category)
                                <div class="col-auto">
                                    <input 
                                        class="btn-check" 
                                        type="checkbox" 
                                        value="{{ $category->id }}" 
                                        name="categories[]"
                                        id="{{ $category->slug }}"
                                        {{ (is_array(old('categories')) and in_array($category['slug'], old('categories'))) ? ' checked' : '' }}
                                    >
                                    <label class="btn btn-sm btn-outline-secondary" for="{{ $category->slug }}">
                                        {{ $category->name }}
                                    </label>
                                </div>
                            @endforeach
                        </section>
                    @endif
                </fieldset>
                <div class="d-grid mt-4 pt-4 border-top gap-2">
                    <button type="submit" class="btn btn-outline-success">
                        Add lot
                    </button>
                </div>
            </form>
        </article>
    </section>
@endsection