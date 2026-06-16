<x-layout>
    <x-slot:heading> Create Job </x-slot:heading>
    <form action="/jobs" method="post">
        @csrf
        <div>
            <div>
                <H2> Job Profile </H2>
                <p> This information will be displayed publicly so be careful what you share. </p>
                <div>
                    <x-form-field>
                        <x-form-label> Title </x-form-label>
                        <div>
                            <x-form-input id="title" name="title" placeholder="Software Engineer" required></x-form-input>
                            <x-form-error name="title"></x-form-error>
                        </div>
                    </x-form-field>

                    <x-form-field>
                        <x-form-label> Company </x-form-label>
                        <div>
                            <x-form-input id="company" name="company" placeholder="Vista G" required></x-form-input>
                            <x-form-error name="company"></x-form-error>
                        </div>
                    </x-form-field>

                    <x-form-field>
                        <x-form-label> Salary </x-form-label>
                        <div>
                            <x-form-input id="salary" name="salary" placeholder="$30,000"></x-form-input>
                            <x-form-error name="salary"></x-form-error>
                        </div>
                    </x-form-field>
                </div>
            </div>
        </div>
        <div>
            <a href="/jobs"> Cancel </a>
            <x-form-button type="submit"> Save </x-form-button>
        </div>
    </form>
</x-layout>