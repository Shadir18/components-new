<x-layout>
    <x-slot:heading>
        Job Details
    </x-slot:heading>

    <div>
        <div>{{ $job->title }}</div>
        <div >Company: {{ $job->company }}</div>
        <div >Salary: {{ $job->salary }}</div>
        <div >Employer: {{ $job->employer?->name ?? 'Unassigned Employer' }}</div>
        <div class="pt-4">
            <a href="/jobs" >Back to jobs</a>
        </div>
    </div>
    {{-- @can('edit', $job) --}}
        <div class="mt-6">
            <x-button href="/jobs/{{$job->id}}/edit">Edit Job</x-button>
        </div>
    {{-- @endcan --}}
</x-layout>