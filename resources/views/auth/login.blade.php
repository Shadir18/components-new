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
                <form action="/jobs" method="post">
                    @csrf

                    <x-form-field class="form-group mb-4">
                        <x-form-label for="email" class="font-weight-bold text-dark mb-2">Email Address</x-form-label>
                        <div>
                            <x-form-input id="email" name="email" type="email" placeholder="testuser@gmail.com" class="form-control" required></x-form-input>
                            <x-form-error name="email" class="invalid-feedback d-block mt-1"></x-form-error>
                        </div>
                    </x-form-field>

                    <x-form-field class="form-group mb-4">
                        <x-form-label for="password" class="font-weight-bold text-dark mb-2">Password</x-form-label>
                        <div>
                            <x-form-input id="password" name="password" type="password" class="form-control" required></x-form-input>
                            <x-form-error name="password" class="invalid-feedback d-block mt-1"></x-form-error>
                        </div>
                    </x-form-field>

                    <div class="border-top pt-3 mt-4 d-flex justify-content-end align-items-center">
                        <a href="/jobs" class="btn btn-light border mr-2 px-4"> Go Back </a>
                        <x-form-button type="submit" class="btn btn-primary px-4 font-weight-bold">
                            Login
                        </x-form-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>