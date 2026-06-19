<x-layout>
    <x-slot:heading>
        Create Job
    </x-slot:heading>

    <div class="container my-5">
        <div class="card shadow-sm mx-auto" style="max-width: 700px;">
            <div class="card-header bg-dark text-white p-4">
                <h2 class="h4 mb-1 font-weight-bold">Job Profile</h2>
                <p class="text-muted small mb-0 text-light opacity-75">
                    This information will be displayed publicly, so please be careful what you share.
                </p>
            </div>
            
            <div class="card-body p-4">
                <div id="success-alert" class="alert alert-success d-none mb-4 font-weight-bold"></div>

                <form id="createJobForm">
                    @csrf
                    
                    <x-form-field class="form-group mb-4">
                        <x-form-label for="title" class="font-weight-bold text-dark mb-2">Job Title</x-form-label>
                        <div>
                            <x-form-input id="title" 
                                          name="title" 
                                          placeholder="Software Engineer" 
                                          class="form-control" 
                                          required>
                            </x-form-input>
                            <x-form-error name="title" class="invalid-feedback d-block mt-1"></x-form-error>
                        </div>
                    </x-form-field>

                    <x-form-field class="form-group mb-4">
                        <x-form-label for="company" class="font-weight-bold text-dark mb-2">Company</x-form-label>
                        <div>
                            <x-form-input id="company" 
                                          name="company" 
                                          placeholder="Vista G" 
                                          class="form-control" 
                                          required>
                            </x-form-input>
                            <x-form-error name="company" class="invalid-feedback d-block mt-1"></x-form-error>
                        </div>
                    </x-form-field>

                    <x-form-field class="form-group mb-4">
                        <x-form-label for="salary" class="font-weight-bold text-dark mb-2">Salary</x-form-label>
                        <div>
                            <x-form-input id="salary" 
                                          name="salary" 
                                          placeholder="$30,000" 
                                          class="form-control">
                            </x-form-input>
                            <x-form-error name="salary" class="invalid-feedback d-block mt-1"></x-form-error>
                        </div>
                    </x-form-field>

                    <div class="border-top pt-3 mt-4 d-flex justify-content-end align-items-center">
                        <a href="/jobs" class="btn btn-light border mr-2 px-4"> Cancel </a>
                        @auth
                            <x-form-button type="submit" class="btn btn-primary px-4 font-weight-bold">
                                Save Job
                            </x-form-button>
                        @else
                            <a href="/login" class="btn btn-secondary px-4">Log in to Post a Job</a>
                        @endauth
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>
<script>
    document.getElementById('createJobForm').addEventListener('submit', async function(event) {
        event.preventDefault(); 
        
        document.querySelectorAll('[id$="-error"], #success-alert').forEach(el => el.classList.add('d-none'));

        try {
            const data = Object.fromEntries(new FormData(this));
            const response = await axios.post('/jobs', data);
            
            const successAlert = document.getElementById('success-alert');

            setTimeout(() => {
                window.location.href = '/jobs';
            }, 2000);

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