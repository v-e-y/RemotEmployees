@extends('index')

@section('main')
    <section class="col-12 col-md-9 col-lg-6">
        <article class="card">
            @if (isset($category))
                <form action="{{ route('category.update', [$category->id]) }}" method="post" class="card-body">
                {{ method_field('PATCH') }}
            @else
                <form action="{{ route('category.store') }}" method="post" class="card-body">
            @endif
                <fieldset>
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Category name</label>
                        <input 
                            type="text" 
                            class="form-control @error('name') is-invalid @enderror" 
                            value="{{ old('name') ?? $category->name ?? '' }}"
                            name="name" 
                            id="name"
                            required 
                            autofocus
                        >
                    </div>
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
                        >{{ old('description') ?? $category->description ?? ''}}</textarea>
                    </div>
                </fieldset>
                <div class="d-grid mt-4 pt-4 border-top gap-2">
                    <button type="submit" class="btn btn-outline-success">
                        {{ (isset($category)) ? 'Update' : 'Add' }} category
                    </button>
                </div>
            </form>
        </article>
    </section>
@endsection