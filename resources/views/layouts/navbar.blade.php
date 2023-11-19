<nav class="navbar navbar-expand-lg navbar-dark p-3 text-white">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Hello,</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto ">
                <li class="nav-item">
                    <a class="nav-link mx-2 active" aria-current="page" href="{{ route('dashboard') }}">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link mx-2 dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Options
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="#">Your Profile</a></li>
                        <li><a class="dropdown-item" href="#">About Us</a></li>
                        <li><a class="dropdown-item" href="#">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="btn btn-danger" type="submit">Logout</button>
                                </form>
                            </a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-2 " aria-current="page" href="#">Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-2 " aria-current="page" href="{{ route('viewProducts') }}">View Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-2" href="{{ route('addProduct') }}">Add Products</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
