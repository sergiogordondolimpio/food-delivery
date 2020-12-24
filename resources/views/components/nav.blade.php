<nav class="navbar navbar-expand-lg navbar-light bg-dark">
    <div class="collapse navbar-collapse ml-5" id="navbarLeft">
      <a class="navbar-brand text-white" href="#">Navbar</a>
      <ul class="navbar-nav">
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
            <a class="dropdown-item" href="#">Admin</a>
            <a class="dropdown-item" href="/addProduct">Add</a>
            <a class="dropdown-item" href="/listProducts">List</a>
          </div>
        </li>
      </ul>
    </div>
    <nav class="navbar navbar-dark bg-dark">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarLeft" aria-controls="navbarLeft" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </nav>


    <div class="collapse navbar-collapse mr-5" id="navbarRight" style="justify-content: flex-end;">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-white" href="/">Login <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="#">Logout</a>
        </li>
        <li class="nav-item ml-2" style="align-self: center;">
          <button type="button" class="btn btn-primary btn-sm">
            Cart <span class="badge badge-light">0</span>
          </button>
        </li>
      </ul>
    </div>
    <nav class="navbar navbar-dark bg-dark">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarRight" aria-controls="navbarRight" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </nav>
  </nav>