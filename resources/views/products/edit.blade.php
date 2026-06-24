<x-layout>
    <x-slot:heading>
        Edit Product: {{ $product->title }}
    </x-slot:heading>

    <div class="container my-5">
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white">
                <h4 class="mb-0">Product Details</h4>
            </div>
            
            <div class="card-body">
                <form id="editProductForm" method="POST" action="/products/{{ $product->id }}" >
                    @csrf
                    @method('PATCH')
                    
                    <div class="form-group mb-4">
                        <label for="title" class="font-weight-bold">Product Name</label>
                        <input id="title" 
                               type="text" 
                               name="title" 
                               class="form-control @error('title') is-invalid @enderror" 
                               value="{{ $product->title }}" 
                               required>
                        @error('title') 
                            <div class="invalid-feedback">{{ $message }}</div> 
                        @enderror
                    </div>
                    
                    <div class="form-group mb-4">
                        <label for="company" class="font-weight-bold">Company</label>
                        <x-form-input id="company" 
                                      type="text" 
                                      name="company" 
                                      class="form-control" 
                                      value="{{ $product->company }}">
                        </x-form-input>
                    </div>

                    <div class="form-group mb-4">
                        <label for="price" class="font-weight-bold">Price</label>
                        <x-form-input id="price" 
                                      type="text" 
                                      name="price" 
                                      class="form-control" 
                                      value="{{ $product->price }}">
                        </x-form-input>
                        @error('price') 
                            <div class="invalid-feedback">{{ $message }}</div> 
                        @enderror
                    </div>

                    <div class="border-top pt-3 d-flex justify-content-between align-items-center">
                        <button type="submit" form="delete-form" class="btn btn-outline-danger">
                            <i class="fas fa-trash-alt mr-1"></i> Delete Product
                        </button>
                        
                        <div>
                            <a href="/products/{{ $product->id }}" class="btn btn-light border mr-2"> Cancel </a>
                            <button type="submit" class="btn btn-primary px-4"> Update Product </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <form method="POST" action="/products/{{ $product->id }}" id="delete-form" class="d-none">
        @csrf
        @method('DELETE')
    </form>
</x-layout>
<script type="module">
$('#editProductForm').on('submit', function(event) {
    event.preventDefault();

    $('[id$="-error"]').text('').addClass('d-none');

    const data = {
        title: $('#title').val(),
        company: $('#company').val(),
        price: $('#price').val(),
    };

    $.ajax({
        url: '/products/{{ $product->id }}',
        type: 'PATCH',
        data: data
    })
    .done(function(response) {
        window.location.href = response.redirect_url;
    })
    .fail(function(xhr) {
        if (xhr.status === 422) {
            $.each(xhr.responseJSON.errors, function(field, messages) {
                const errorEl = $(`#${field}-error`);
                if (errorEl.length) {
                    errorEl.text(messages[0]).removeClass('d-none');
                }
            });
        }
    });
});

$('#delete-form').on('submit', function(event) {
    event.preventDefault();
    
    $.ajax({
        url: '/products/{{ $product->id }}',
        type: 'DELETE'
    })
    .done(function(response) {
        window.location.href = response.redirect_url;
    })
    .fail(function(xhr) {
        console.error('An error occurred during deletion execution:', xhr.responseText);
        alert('Could not delete the product listing record. Please try again.');
    });
});
</script>