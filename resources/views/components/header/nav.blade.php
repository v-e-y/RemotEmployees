<nav class="navbar bg-transparent">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">RemotEmployees</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">RemotEmployees menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item">
                    <a class="nav-link"  href="{{ route('product.create') }}">
                        Add lot
                    </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('category.create') }}">
                            Create category
                        </a>
                    </li>
                    @isset($categories_menu)
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Categories
                            </a>
                            <ul class="dropdown-menu">
                                @foreach ($categories_menu as $category)
                                    <li>
                                        <a 
                                            class="dropdown-item" 
                                            href="{{ route('category.showProducts', [$category->slug]) }}"
                                        >
                                            {{ $category->name}}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endisset
                </ul>
            </div>
        </div>
    </div>
</nav>