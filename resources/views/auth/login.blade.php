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

<script type="module">
    $(document).ready(function(){
        $('#loginForm').on('submit', function(e){
            e.preventDefault();
            const email = $('#email').val();
            const password = $('#password').val();
            axios.post('/login', {
                email: email,
                password: password
            })
            .then(function(response){
                if (response.data.token){
                    localStorage.setItem('token', response.data.token);
                }
                window.location.href = '/products';
                console.log(response.data);
            })
            .catch(function(error){
                console.error(error);
                if (error.response && error.response.status === 422) {
                    const error = error.response.data.error;
                    if (errors.email) {
                        $('#email-error').removeClass('d-none').text(errors.email[0]);
                    }
                    if (errors.password) {
                        $('#password-error').removeClass('d-none').text(errors.password[0]);
                    }
                } else if (error.response && error.response.data && error.response.data.message) {
                    $('#general-error').removeClass('d-none').text(error.response.data.message);
                } else {
                    $('#general-error').removeClass('d-none').text('Please try again later.');
                }
            });
        });
    });
</script>
