<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="{{route('home')}}"><img width="35px" height="35px" src="{{asset('/img/logo.png')}}" alt=""></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          @auth
            @if(auth()->user()->isAdmin())
              <li class="nav-item">
                <a class="nav-link" href="{{route('admin.dashboard')}}">Dashboard</a>
              </li>
            @endif
          @endauth
          <li class="nav-item">
            <a class="nav-link @if(Route::currentRouteName() == 'home') {{'active'}} @endif" aria-current="page" href="{{route('home')}}">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link @if(Route::currentRouteName() == 'blog.index') {{'active'}} @endif" href="{{route('blog.index')}}">Blog</a>
          </li>
          <li class="nav-item">
            <a class="nav-link @if(Route::currentRouteName() == 'contact') {{'active'}} @endif" href="{{route('contact')}}">Contact</a>
          </li>
        </ul>
        <form class="d-flex" action="{{route('post.search')}}">
          <input name="search" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-success" type="submit">Search</button>
        </form>
        @auth
          <a href="{{route('user.logout')}}" class="btn btn-danger ms-2" type="submit">Logout</a>
          @else
          <a href="{{route('user.login')}}" class="btn btn-secondary ms-5" type="submit">Login</a>
          <a href="{{route('user.register')}}" class="btn btn-primary ms-2" type="submit">Register</a>
        @endauth
      </div>
    </div>
  </nav>