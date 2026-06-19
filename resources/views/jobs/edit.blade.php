<x-layout>
    <x-slot:heading>
        Edit Job: {{ $job->title }}
    </x-slot:heading>

    <div class="container my-5">
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white">
                <h4 class="mb-0">Job Details</h4>
            </div>
            
            <div class="card-body">
                <form id="editJobForm" method="POST" action="/jobs/{{ $job->id }}" >
                    @csrf
                    @method('PATCH')
                    
                    <div class="form-group mb-4">
                        <label for="title" class="font-weight-bold">Job Title</label>
                        <input id="title" 
                               type="text" 
                               name="title" 
                               class="form-control @error('title') is-invalid @enderror" 
                               value="{{ $job->title }}" 
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
                                      value="{{ $job->company }}">
                        </x-form-input>
                    </div>

                    <div class="form-group mb-4">
                        <label for="salary" class="font-weight-bold">Salary</label>
                        <x-form-input id="salary" 
                                      type="text" 
                                      name="salary" 
                                      class="form-control" 
                                      value="{{ $job->salary }}">
                        </x-form-input>
                        @error('salary') 
                            <div class="invalid-feedback">{{ $message }}</div> 
                        @enderror
                    </div>

                    <div class="border-top pt-3 d-flex justify-content-between align-items-center">
                        <button type="submit" form="delete-form" class="btn btn-outline-danger">
                            <i class="fas fa-trash-alt mr-1"></i> Delete Job
                        </button>
                        
                        <div>
                            <a href="/jobs/{{ $job->id }}" class="btn btn-light border mr-2"> Cancel </a>
                            <button type="submit" class="btn btn-primary px-4"> Update Job </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <form method="POST" action="/jobs/{{ $job->id }}" id="delete-form" class="d-none">
        @csrf
        @method('DELETE')
    </form>
</x-layout>
<script>
document.getElementById('editJobForm').addEventListener('submit', async function(event) {
    event.preventDefault();

    document.querySelectorAll('[id$="-error"]').forEach(el => {
        el.innerText = '';
        el.classList.add('d-none');
    });

    try {
        const data = {
            title: document.querySelector('#title').value,
            company: document.querySelector('#company').value,
            salary: document.querySelector('#salary').value,
        };
        const response = await axios.patch('/jobs/{{ $job->id }}', data);
        window.location.href = response.data.redirect_url;
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
document.getElementById('delete-form').addEventListener('submit', async function (event) {
    event.preventDefault();
    try {
        const response = await axios.delete('/jobs/{{ $job->id }}');

    window.location.href = response.data.redirect_url;
    } catch (error) {
        console.error('An error occurred during deletion execution:', error);
        alert('Could not delete the job listing record. Please try again.');
    }
});
</script>