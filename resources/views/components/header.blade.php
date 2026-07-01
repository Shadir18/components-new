<nav class="navbar navbar-expand-md bg-body-secondary shadow" data-bs-theme="dark">
  <div class="container fluid">
    <div class="collapse navbar-collapse" id="navbarNav">
      <div class="navbar-nav ms-auto align-items-center">
        @guest
          <x-nav-link href="/login" :active="request()->is('login')" class="nav-item nav-link mx-2">Log In</x-nav-link>
          <x-nav-link href="/register" :active="request()->is('register')" class="nav-item nav-link mx-2">Register</x-nav-link>
        @endguest

        @auth
          <span class="navbar-text text-light small mx-2">
            Welcome, {{ auth()->user()->first_name }}
          </span>
          <form method="POST" action="/" class="form-inline mx-2">
            @csrf
            <button type="submit" onclick="handleLogout()" class="btn btn-danger btn-sm px-3 font-weight-bold">Log Out</button>
          </form>
        @endauth
      </div>
    </div>
  </div>
</nav>