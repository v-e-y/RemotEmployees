

<nav class="navbar navbar-expand-sm bg-transparent">
    <div class="container">
        <a class="navbar-brand" href="/">RemotEmployees</a>
        <button 
            class="navbar-toggler" 
            type="button" 
            data-bs-toggle="collapse" 
            data-bs-target="#navbarNav" 
            aria-controls="navbarText" 
            aria-expanded="false" 
            aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a 
                        class="nav-link active" 
                        href="{{ route('product.create') }}"
                    >
                        Add lot
                    </a>
                </li>
                <li class="nav-item">
                    <a 
                        class="nav-link active" 
                        href="#"
                    >
                        Create deal
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>