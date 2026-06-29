<x-layout>
    <x-slot:heading>
        Register
    </x-slot:heading>

    <div class="register-page bg-body-secondary py-2">
        <div class="register-box mx-auto" style="max-width: 500px;">
            <div class="card card-outline card-primary shadow-sm">
                
                <div class="card-header text-center p-4">
                    <h2 class="h4 mb-1 fw-bold">Create Account</h2>
                    <p class="small text-muted mb-0">
                        Please fill out the details below to create your secure user account.
                    </p>
                </div>

                <div class="card-body register-card-body p-4">
                    <div id="success-alert" class="alert alert-success d-none mb-3 fw-bold"></div>

                    <form id="registerForm py-10">
                        @csrf
                        
                        <x-form-field class="mb-3">
                            <x-form-label for="first_name" class="fw-bold mb-1">First Name</x-form-label>
                            <div class="input-group ">
                                <input  id="first_name" name="first_name" placeholder="Shadir" class="form-control mb-2" required>
                                 <div class="input-group-text bg-light border-start-0 text-muted">
                                    <span class="bi bi-person"></span>
                                </div>
                            </div>
                            <span id="first_name-error" class="text-danger small mt-1 d-none d-block"></span>
                            {{-- <x-form-label for="first_name" class="fw-bold mb-1">First Name</x-form-label>
                            <div class="input-group w-100">
                                <input id="first_name" name="first_name" placeholder="Shadir" class="align-items-center form-control mb-2" required />
                                <div class="input-group-text bg-light border-start-0 text-muted">
                                    <span class="bi bi-person"></span>
                                </div>
                            </div> --}}
                            <span id="first_name-error" class="text-danger small mt-1 d-none d-block"></span>
                        </x-form-field>

                        <x-form-field class="mb-3">
                            <x-form-label for="last_name" class="fw-bold mb-1">Last Name</x-form-label>
                            <div class="input-group">
                                <input id="last_name" name="last_name" placeholder="Vista G" class="form-control mb-2" required />
                                <div class="input-group-text bg-light border-start-0 text-muted">
                                    <span class="bi bi-person-vcard"></span>
                                </div>
                            </div>
                            <span id="last_name-error" class="text-danger small mt-1 d-none d-block"></span>
                        </x-form-field>

                        <x-form-field class="mb-3">
                            <x-form-label for="email" class="fw-bold mb-1">Email Address</x-form-label>
                            <div class="input-group">
                                <input id="email" name="email" type="email" placeholder="testuser@gmail.com" class="form-control mb-2" required />
                                <div class="input-group-text bg-light border-start-0 text-muted">
                                    <span class="bi bi-envelope"></span>
                                </div>
                            </div>
                            <span id="email-error" class="text-danger small mt-1 d-none d-block"></span>
                        </x-form-field>

                        <x-form-field class="mb-3">
                            <x-form-label for="password" class="fw-bold mb-1">Password</x-form-label>
                            <div class="input-group">
                                <input id="password" name="password" type="password" placeholder="••••••••" class="form-control mb-2" required />
                                <div class="input-group-text bg-light border-start-0 text-muted">
                                    <span class="bi bi-lock-fill"></span>
                                </div>
                            </div>
                            <span id="password-error" class="text-danger small mt-1 d-none d-block"></span>
                        </x-form-field>

                        <x-form-field class="mb-4">
                            <x-form-label for="password_confirmation" class="fw-bold mb-1">Confirm Password</x-form-label>
                            <div class="input-group">
                                <input id="password_confirmation" name="password_confirmation" type="password" placeholder="••••••••" class="form-control mb-2" required />
                                <div class="input-group-text bg-light border-start-0 text-muted">
                                    <span class="bi bi-shield-lock"></span>
                                </div>
                            </div>
                            <span id="password_confirmation-error" class="text-danger small mt-1 d-none d-block"></span>
                        </x-form-field>

                        <div class="d-flex justify-content-between align-items-center border-top pt-3">
                            <a href="/products" class="btn btn-light border px-4">Go Back</a>
                            <x-form-button type="submit" class="btn btn-primary px-4 fw-bold">Register</x-form-button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-layout>

<script type="module">
    $(document).ready(function(){
        $('#registerForm').on('submit', function(e){
            e.preventDefault();
            const formData = Object.fromEntries(new FormData(this));
            axios.post('/register', formData)
            .then(function(response){
                if (response.data && response.data.redirect_url){
                    window.location.href = response.data.redirect_url;
                } else {
                    window.location.href = '/products';
                }
            })
            .catch(function(error){
                console.error(error);
                if (error.response && error.response.status === 422) {
                    const errors = error.response.data.errors;
                } else {
                    alert ('something went wrong, try again later');
                }
            });
        });
    });
</script>