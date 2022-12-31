@extends('index')

@section('main')
    <section class="col-12 col-md-9 col-lg-6">
        <article class="card">
            <form action="{{ route('product.store') }}" method="post" class="card-body">
                <fieldset>
                    <div class="mb-3">
                        <label for="name" class="form-label">Lot name</label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                </fieldset>
            </form>
        </article>
    </section>
@endsection