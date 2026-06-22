<x-layout>
    <x-slot:heading>
        Register
    </x-slot:heading>

    <div class="container my-5">
        <div class="card shadow-sm mx-auto" style="max-width: 700px;">
            <div class="card-header bg-dark text-white p-4">
                <h2 class="h4 mb-1 font-weight-bold">Create Account</h2>
                <p class="text-muted small mb-0 text-light opacity-75">
                    Please fill out the details below to create your secure user account.
                </p>
            </div>
            
            <div class="card-body p-4">
                <div id="success-alert" class="alert alert-success d-none mb-4 font-weight-bold"></div>

                <form id="registerForm">
                    @csrf
                    
                    <x-form-field class="form-group mb-4">
                        <x-form-label for="first_name" class="font-weight-bold text-dark mb-2">First Name</x-form-label>
                        <div>
                            <x-form-input id="first_name" name="first_name" placeholder="Shadir" class="form-control" required></x-form-input>
                            <span id="first_name-error" class="text-danger small mt-1 d-none"></span>
                        </div>
                    </x-form-field>

                    <x-form-field class="form-group mb-4">
                        <x-form-label for="last_name" class="font-weight-bold text-dark mb-2">Last Name</x-form-label>
                        <div>
                            <x-form-input id="last_name" name="last_name" placeholder="Vista G" class="form-control" required></x-form-input>
                            <span id="last_name-error" class="text-danger small mt-1 d-none"></span>
                        </div>
                    </x-form-field>

                    <x-form-field class="form-group mb-4">
                        <x-form-label for="email" class="font-weight-bold text-dark mb-2">Email Address</x-form-label>
                        <div>
                            <x-form-input id="email" name="email" type="email" placeholder="testuser@gmail.com" class="form-control" required></x-form-input>
                            <span id="email-error" class="text-danger small mt-1 d-none"></span>
                        </div>
                    </x-form-field>

                    <x-form-field class="form-group mb-4">
                        <x-form-label for="password" class="font-weight-bold text-dark mb-2">Password</x-form-label>
                        <div>
                            <x-form-input id="password" name="password" type="password" class="form-control" required></x-form-input>
                            <span id="password-error" class="text-danger small mt-1 d-none"></span>
                        </div>
                    </x-form-field>

                    <x-form-field class="form-group mb-4">
                        <x-form-label for="password_confirmation" class="font-weight-bold text-dark mb-2">Confirm Password</x-form-label>
                        <div>
                            <x-form-input id="password_confirmation" name="password_confirmation" type="password" class="form-control" required></x-form-input>
                            <span id="password_confirmation-error" class="text-danger small mt-1 d-none"></span>
                        </div>
                    </x-form-field>

                    <div class="border-top pt-3 mt-4 d-flex justify-content-end align-items-center">
                        <a href="/products" class="btn btn-light border mr-2 px-4"> Go Back </a>
                        <x-form-button type="submit" class="btn btn-primary px-4 font-weight-bold">
                            Register
                        </x-form-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>
<script>
    document.getElementById('registerForm').addEventListener('submit', async function(event) {
        event.preventDefault(); 
        document.querySelectorAll('[id$="-error"], #success-alert').forEach(el => el.classList.add('d-none'));
        try {
            const data = Object.fromEntries(new FormData(this));
            const response = await axios.post('/register', data);

            setTimeout(() => window.location.href = '/products', 100);
        } catch (error) {
            if (error.response?.status === 422) {
                Object.entries(error.response.data.errors).forEach(([field, messages]) => {
                    const errorEl = document.getElementById(`${field}-error`);
                    if (errorEl) {
                        errorEl.innerText = messages[0];
                        errorEl.classList.remove('d-none');
                    }
                });
            }
        }
    });
</script>
