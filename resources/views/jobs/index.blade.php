<x-layout>
    <x-slot:heading>
        <span>Job Details</span>
        <x-button href="{{ route('jobs.create') }}">Post Job</x-button>
    </x-slot:heading>

    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <div class="d-flex flex-column gap-3">
                @foreach ($jobs as $job)
                    <a href="/jobs/{{ $job['id'] }}" class="text-decoration-none p-4 border border-secondary-subtle rounded-3 bg-white list-group-item-action">
                        <div class="fw-bold text-primary small mb-2">
                            {{ $job->employer?->name ?? 'Unassigned Employer' }}
                        </div>

                        <div class="text-dark">
                            <strong class="text-primary">{{ $job['title'] }}:</strong> 
                            Pays {{ $job['salary'] }} per year.
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-4">
                {{ $jobs->links() }}
            </div>
        </div>
    </div>
</x-layout>