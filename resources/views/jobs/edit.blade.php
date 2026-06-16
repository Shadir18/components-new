<x-layout>
    <x-slot:heading>
        Edit Job {{ $job->title }}
    </x-slot:heading>

    <form method="POST" action="/jobs/{{ $job->id }}">
        @csrf
        @method('PATCH')
        
        <div>
            <div>
                <label for="title"> Job Title </label>
                <input id="title" type="text" name="title" class="form-control w-50" value="{{ $job->title }}" required>
                @error('title') <p class="text-danger">{{ $message }}</p> @enderror
            </div>
            
            <div class="mt-3">
                <label for="company"> Company </label>
                <x-form-input id="company" type="text" name="company" class="form-control w-50" value="{{ $job->company }}"></x-form-input>
            </div>

            <div class="mt-3">
                <label for="salary"> Salary </label>
                <x-form-input id="salary" type="text" name="salary" value="{{ $job->salary }}"></x-form-input>
                @error('salary') <p class="text-danger">{{ $message }}</p> @enderror
            </div>

            <div class="d-flex justify-content-between align-items-center mt-4">
                <button type="submit" form="delete-form" class="btn btn-danger"> Delete </button>
                
                <div>
                    <a href="/jobs/{{ $job->id }}" class="btn btn-warning"> Cancel </a>
                    <button type="submit" class="btn btn-primary"> Update </button>
                </div>
            </div>
        </div>
    </form>

    <form method="POST" action="/jobs/{{ $job->id }}" id="delete-form" class="d-none">
        @csrf
        @method('DELETE')
    </form>
</x-layout>