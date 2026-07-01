@props(['active' => false])

<a {{ $attributes->class(['nav-link']) }}>
    {{ $slot }}
</a>