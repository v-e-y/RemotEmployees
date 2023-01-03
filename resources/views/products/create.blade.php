@extends('index')

@section('main')
    <section class="col-12 col-md-9 col-lg-6">
        <article class="card">
            @if (isset($product))
                <form action="{{ route('product.update', [$product->id]) }}" method="post" class="card-body">
                {{ method_field('PATCH') }}
            @else
                <form action="{{ route('product.store') }}" method="post" class="card-body">
            @endif
                <fieldset>
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Lot name</label>
                        <input 
                            type="text" 
                            class="form-control @error('name') is-invalid @enderror" 
                            value="{{ old('name') ?? $product->name ?? '' }}"
                            name="name" 
                            id="name"
                            required 
                            autofocus
                        >
                    </div>
                    <section class="row g-2">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input 
                                        type="number" 
                                        step="0.01" 
                                        class="form-control @error('price') is-invalid @enderror" 
                                        value="{{ old('price') ?? $product->price ?? ''}}"
                                        name="price" 
                                        id="price"
                                        required
                                    >
                                </div>
                            </div>
                        </div>
                        @if (isset($conditions) && $conditions->count())
                            <div class="col-6">
                                <label for="condition_id" class="form-label">Condition</label>
                                <select 
                                    class="form-select" 
                                    aria-label="Select lot condition"
                                    id="condition_id"
                                    name="condition_id"
                                >
                                    <option selected disabled hidden>Choose condition</option>
                                    @foreach ($conditions as $condition)
                                        <option 
                                            value="{{ $condition->id }}"
                                            @if (old('condition_id') === $condition->id)
                                                selected
                                            @endif
                                            @if (isset($product) && $product->condition_id === $condition->id)
                                                selected
                                            @endif
                                        >
                                            {{ $condition->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                    </section>
                    <div class="mb-3">
                        <label for="description" class="form-label">
                            Description
                        </label>
                        <textarea 
                            name="description" 
                            id="description" 
                            cols="30" 
                            rows="10" 
                            class="form-control @error('description') is-invalid @enderror" 
                            required
                        >{{ old('description') ?? $product->description ?? ''}}</textarea>
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
                                        id="{{ $category->id }}"
                                        {{ (is_array(old('categories')) and in_array($category['id'], old('categories'))) ? ' checked' : '' }}
                                        @if (isset($product) && $product->categories->count())
                                            @foreach ($product->categories as $pCategory)
                                                {{ ($pCategory->id === $category->id) ?  ' checked'  : '' }}
                                            @endforeach
                                        @endif 
                                    >
                                    <label class="btn btn-sm btn-outline-secondary" for="{{ $category->id }}">
                                        {{ $category->name }}
                                    </label>
                                </div>
                            @endforeach
                        </section>
                    @endif
                </fieldset>
                <div class="d-grid mt-4 pt-4 border-top gap-2">
                    <button type="submit" class="btn btn-outline-success">
                        {{ (isset($product)) ? 'Update' : 'Add' }} lot
                    </button>
                </div>
            </form>
        </article>
    </section>
@endsection