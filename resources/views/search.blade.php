
@if (auth()->check())
    {{-- اگر کاربر لاگین کرده باشد --}}
    <x-app-layout>
        <livewire:course.search />
    </x-app-layout>
@else
    {{-- اگر کاربر لاگین نکرده باشد --}}
    <x-guest-layout>
        <livewire:course.search />
    </x-guest-layout>
@endif