<x-layout>
    <x-slot:heading>
        Login Page
    </x-slot:heading>

    <div class="login-page bg-body-secondary d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="login-box" style="width: 360px;">
            <div class="login-logo text-center mb-3">
                <a href="/products" class="text-decoration-none text-dark"><b>Vista</b>G</a>
            </div>
            
            <div class="card shadow-sm border-0">
                <div class="card-body login-card-body p-4">
                    <h2 class="h4 mb-1 font-weight-bold text-center mb-5">Enter Login details</h2>
                    <form id="loginForm" method="POST" action="/login">
                        @csrf
                        <div id="general-error" class="alert alert-danger d-none mb-3 small"></div>

                        <x-form-field class="mb-3">
                            <div class="d-flex justify-content-center align-items-center input-group mb-3 ">
                                <x-form-input id="email" name="email" type="email" placeholder="Email" class="form-control" required></x-form-input>
                                <div class="input-group-text bg-light border-start-0 text-muted">
                                    <span class="bi bi-envelope"></span>
                                </div>
                            </div>
                            <span id="email-error" class="text-danger small mt-1 d-none"></span>
                        </x-form-field>

                        <x-form-field class="mb-3">
                            <div class=" d-flex justify-content-center align-items-center input-group mb-3">
                                <x-form-input id="password" name="password" type="password" placeholder="Password" class="form-control" required></x-form-input>
                                <div class="input-group-text bg-light border-start-0 text-muted">
                                    <span class="bi bi-lock-fill"></span>
                                </div>
                            </div>
                            <span id="password-error" class="text-danger small mt-1 d-none"></span>
                        </x-form-field>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember" name="remember_me">
                                <label class="form-check-label small user-select-none text-muted" for="remember">
                                    Remember Me
                                </label>
                            </div>
                            <a href="/forgot-password" class="text-decoration-none small">Forgot password?</a>
                        </div>
                        <div class="d-grid mb-3">
                            <x-form-button type="submit" class="btn btn-primary py-2 font-weight-bold shadow-sm">
                            Sign In
                            </x-form-button>
                        </div>
                    </form>

                    <div class="text-center border-top pt-3 mt-3">
                        <p class="mb-0 small text-muted">
                            Don't have an account? <a href="/register" class="text-decoration-none text-success font-weight-bold">Register</a>
                        </p>
                    </div>
                </div>
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
                    const errors = error.response.data.error;
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