@props(['active' => false])

<a {{ $attributes }} 
   class="nav-link {{ $active ? 'active' : '' }}" 
   aria-current="{{ $active ? 'page' : 'false' }}">
    {{ $slot }}
</a>