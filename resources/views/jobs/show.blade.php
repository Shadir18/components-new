<x-layout>
    <x-slot:heading>
        Job Details
    </x-slot:heading>

    <div class="container my-5">
        <div class="card shadow-sm mx-auto" style="max-width: 600px;">
            <div class="card-header bg-dark text-white p-4">
                <h2 class="h4 mb-0 font-weight-bold">{{ $job->title }}</h2>
            </div>
            
            <div class="card-body p-4">
                <div class="row mb-3">
                    <div class="col-sm-4 text-muted font-weight-bold">Company:</div>
                    <div class="col-sm-8 text-dark font-weight-semibold">{{ $job->company }}</div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-sm-4 text-muted font-weight-bold">Salary:</div>
                    <div class="col-sm-8 text-success font-weight-bold">{{ $job->salary }}</div>
                </div>
                
                <div class="row mb-4">
                    <div class="col-sm-4 text-muted font-weight-bold">Employer:</div>
                    <div class="col-sm-8">
                        <span class="badge {{ $job->employer?->name ? 'badge-info' : 'badge-secondary' }} px-3 py-2">
                            {{ $job->employer?->name ?? 'Unassigned Employer' }}
                        </span>
                    </div>
                </div>

                <div class="border-top pt-3 d-flex justify-content-between align-items-center">
                    <a href="/jobs" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left mr-1"></i> Back to Jobs
                    </a>

                    @can('edit', $job)
                    <div>
                        <x-button href="/jobs/{{$job->id}}/edit" class="btn btn-warning font-weight-bold">
                            Edit Job
                        </x-button>
                    </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</x-layout>