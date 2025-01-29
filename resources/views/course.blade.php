@if (Auth::user() && Auth::user()->teacher == 1)
<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <livewire:course.create />
        <livewire:course.list />
    </div>
</x-app-layout>
@else
    @php
        throw new \Illuminate\Auth\Access\AuthorizationException();
    @endphp
@endif
