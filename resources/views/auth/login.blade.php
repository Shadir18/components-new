<x-layout>
    <x-slot:heading>
        Login Page
    </x-slot:heading>

    <div class="container my-5">
        <div class="card shadow-sm mx-auto" style="max-width: 700px;">
            <div class="card-header bg-dark text-white p-4">
                <h2 class="h4 mb-1 font-weight-bold">Enter Login details</h2>
                <p class="text-muted small mb-0 text-light opacity-75">
                    Please fill out the details below to create your secure user account.
                </p>
            </div>
            
            <div class="card-body p-4">
                <form id="loginForm">
                    @csrf

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

                    <div id="general-error" class="alert alert-danger d-none mb-3"></div>

                    <div class="border-top pt-3 mt-4 d-flex justify-content-end align-items-center">
                        <a href="/products" class="btn btn-light border mr-2 px-4"> Go Back </a>
                        <x-form-button type="submit" class="btn btn-primary px-4 font-weight-bold">
                            Login
                        </x-form-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>

<script>
    document.getElementById('loginForm').addEventListener('submit', function(event) {
        event.preventDefault(); 
        
        document.getElementById('email-error').classList.add('d-none');
        document.getElementById('password-error').classList.add('d-none');
        document.getElementById('general-error').classList.add('d-none');

        axios.post('/login', {
            email: document.getElementById('email').value,
            password: document.getElementById('password').value
        })
        .then(response => {
            window.location.href = '/products';
        })
        .catch(error => {
            if (error.response && error.response.status === 422) {
                const errors = error.response.data.errors;
                if (errors.email) {
                    document.getElementById('email-error').innerText = errors.email[0];
                    document.getElementById('email-error').classList.remove('d-none');
                }
                if (errors.password) {
                    document.getElementById('password-error').innerText = errors.password[0];
                    document.getElementById('password-error').classList.remove('d-none');
                }
            } else if (error.response && error.response.status === 401) {
                document.getElementById('general-error').innerText = error.response.data.message;
                document.getElementById('general-error').classList.remove('d-none');
            }
        });
    });
</script>
