<x-layout>
    <x-slot:heading>
        <span>Product Details</span>
    </x-slot:heading>

    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <div class="d-flex flex-column gap-3">
                @foreach ($products as $product)
                    <a href="/products/{{ $product['id'] }}" class="text-decoration-none p-4 border border-secondary-subtle rounded-3 bg-white list-group-item-action">
                        <div class="fw-bold text-primary small mb-2">
                            {{ $product->seller?->name ?? 'Unassigned Product' }}
                        </div>

                        <div class="text-dark">
                            <strong class="text-primary">{{ $product['title'] }}:</strong> 
                            Price - {{ $product['price'] }}
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-4">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</x-layout>