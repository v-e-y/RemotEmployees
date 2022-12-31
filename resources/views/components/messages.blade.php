@if(session()->get('message'))
    <div class="alert alert-success alert-dismissible border-0 effect-4" role="alert">
        {{  session()->get('message')  }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif