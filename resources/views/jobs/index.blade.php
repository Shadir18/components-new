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

{{-- <x-layout>
    <x-slot:heading>{{ $job->title ?? 'Jobs' }}</x-slot:heading>

    <section class="container py-4">
        <div class="mb-4">
            <h2 class="h4">Selected Job</h2>
            <p><strong>Title:</strong> {{ $job->title }}</p>
            <p><strong>Company:</strong> {{ $job->company }}</p>
            <p><strong>Salary:</strong> {{ $job->salary }}</p>
        </div>

        <div>
            <h2 class="h4">All Jobs</h2>
            <ul>
                @forelse ($jobs as $jobItem)
                    <li>
                        <a href="{{ route('jobs.show', $jobItem) }}">
                            <strong>{{ $jobItem->title }}</strong>
                        </a>
                        @if($jobItem->company)
                            — {{ $jobItem->company }}
                        @endif
                    </li>
                @empty
                    <li>No jobs available.</li>
                @endforelse
            </ul>
        </div>
    </section>
</x-layout> --}}