
@if (auth()->check())
    {{-- اگر کاربر لاگین کرده باشد --}}
    <x-app-layout>
        <livewire:course.show />
    </x-app-layout>
@else
    {{-- اگر کاربر لاگین نکرده باشد --}}
    <x-guest-layout>
        <livewire:course.show />
    </x-guest-layout>
@endif