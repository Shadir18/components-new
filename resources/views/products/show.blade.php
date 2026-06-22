<x-layout>
    <x-slot:heading>
        Product Details
    </x-slot:heading>

    <div class="container my-5">
        <div class="card shadow-sm mx-auto" style="max-width: 600px;">
            <div class="card-header bg-dark text-white p-4">
                <h2 class="h4 mb-0 font-weight-bold">{{ $product->title }}</h2>
            </div>
            
            <div class="card-body p-4">
                <div class="row mb-3">
                    <div class="col-sm-4 text-muted font-weight-bold">Company:</div>
                    <div class="col-sm-8 text-dark font-weight-semibold">{{ $product->company }}</div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-sm-4 text-muted font-weight-bold">Price:</div>
                    <div class="col-sm-8 text-success font-weight-bold">{{ $product->price }}</div>
                </div>
                
                <div class="row mb-4">
                    <div class="col-sm-4 text-muted font-weight-bold">Seller:</div>
                    <div class="col-sm-8">
                        <span class="badge {{ $product->seller?->name ? 'badge-info' : 'badge-secondary' }} px-3 py-2">
                            {{ $product->seller?->name ?? 'Unassigned Seller' }}
                        </span>
                    </div>
                </div>

                <div class="border-top pt-3 d-flex justify-content-between align-items-center">
                    <a href="/products" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left mr-1"></i> Back to Home
                    </a>

                    @can('edit', $product)
                    <div>
                        <x-button href="/products/{{$product->id}}/edit" class="btn btn-warning font-weight-bold">
                            Edit product
                        </x-button>
                    </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</x-layout>