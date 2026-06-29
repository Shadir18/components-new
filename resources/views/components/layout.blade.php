<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Product CRUD</title>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
</head>
<body>

<div class="min-h-full">
  <nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand font-weight-bold text-uppercase" href="/products">Dashboard</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <div class="navbar-nav ml-auto gap-2">
              <x-nav-link href="/products" :active="request()->is('products')">Home</x-nav-link>
              <x-nav-link href="/about" :active="request()->is('about')">About</x-nav-link>
              <x-nav-link href="/contact" :active="request()->is('contact')">Contact</x-nav-link>
            </div>
            <div class="navbar-nav ml-auto align-items-center">
                    @guest
                        <x-nav-link href="/login" :active="request()->is('login')" class="nav-item nav-link mx-2">Log In</x-nav-link>
                        <x-nav-link href="/register" :active="request()->is('register')" class="nav-item nav-link mx-2">Register</x-nav-link>
                    @endguest

                    @auth
                        <span class="navbar-text text-light small mr-3">
                            Welcome, {{ auth()->user()->first_name }}
                        </span>
                        <form method="POST" action="/" class="form-inline m-0">
                            @csrf
                            <button type="submit" onclick="handleLogout()" class="btn btn-danger btn-sm px-3 font-weight-bold">Log Out</button>
                        </form>
                    @endauth
                </div>
        </div>
    </div>
  </nav>
@auth
  <header class="bg-white py-4 shadow-sm mb-4 border-bottom">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center gap-4"> 
        <h1 class="h3 font-weight-bold mb-0 text-secondary text-tracking" style="letter-spacing: -0.5px;"> 
          {{ $heading ?? '' }} 
        </h1> 
        <div>
          <x-button href="/products/create"> Create Product </x-button>
        </div>
      </div>
    </div>
  </header>
@endauth
  <main>
    {{ $slot }}
  </main>
  
</div>

</body>
</html>
<script type="module">
$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

window.handleLogout = function() {
    $.post('/logout')
        .done(function(response) {
            window.location.href = '/products';
        })
        .fail(function(xhr, status, error) {
            console.error('Logout failed:', error);
        });
}
</script>