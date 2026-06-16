<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

<div class="min-h-full">
  <nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand font-weight-bold text-uppercase" href="/jobs">Dashboard</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <div class="navbar-nav ml-auto gap-2">
              <x-nav-link href="/jobs" :active="request()->is('jobs')">Home</x-nav-link>
              <x-nav-link href="/about" :active="request()->is('about')">About</x-nav-link>
              <x-nav-link href="/contact" :active="request()->is('contact')">Contact</x-nav-link>
            </div>
        </div>
    </div>
  </nav>

  <header class="bg-white py-4 shadow-sm mb-4 border-bottom">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center gap-4"> 
        <h1 class="h3 font-weight-bold mb-0 text-secondary text-tracking" style="letter-spacing: -0.5px;"> 
          {{ $heading }} 
        </h1> 
        <div>
          <x-button href="/jobs/create"> create Job </x-button>
        </div>
      </div>
    </div>
  </header>
  <main>
    {{ $slot }}
  </main>
  
</div>

</body>
</html>