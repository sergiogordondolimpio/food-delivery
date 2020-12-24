
<!-- Left Side Of Navbar -->
<ul class="navbar-nav mr-auto">
    <li class="nav-item active">
        <a class="nav-link text-white" href="/">Home <span class="sr-only">(current)</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-white" href="#">Contact</a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Products
        </a>
        <div class="dropdown-menu text-white" aria-labelledby="navbarDropdownMenuLink">
            @if (Auth::user() && Auth::user()->email == "sergiogordon78@gmail.com")
                <a class="dropdown-item" href="/addProduct">Add</a>
                <a class="dropdown-item" href="/listProducts">List</a>
            @else
                <a class="dropdown-item" href="">Unauthorized</a>
            @endif
            
        </div>
    </li>
</ul>


      