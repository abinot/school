<?php

use App\Models\Course;
use Livewire\Attributes\On;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Volt\Component;

new class extends Component
{
    public Collection $courses;

    public ?Course $editing = null;
    public function delete(Course $course): void

    {
        $this->authorize('delete', $course);
        $course->delete();
        $this->getcourse();
    }
    public function mount(): void
    {
        $this->getcourse();
    }
    #[On('course-created')]
    public function getcourse(): void
    {
        $this->courses = \App\Models\Course::with('user')
            ->latest()
            ->get();
    }
    public function edit(course $course): void
    {
        $this->editing = $course;

        $this->getcourse();
    }
    #[On('course-edit-canceled')]

    #[On('course-updated')] 

    public function disableEditing(): void

    {

        $this->editing = null;

 

        $this->getcourse();

    } 



 

}; ?>

<div>
    <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
        @foreach ($courses as $course)
        
            <div class="p-6 flex space-x-2" wire:key="{{ $course->id }}">
                <div class="flex-1">
                    <div class="flex justify-between items-center">
                        <div>

                            <small class="ml-2 text-sm text-gray-600">{{ $course->created_at->format('j M Y, g:i a') }}</small>

                        </div>
                      
                            <x-dropdown>
                                <x-slot name="trigger">
                                    <button>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                        </svg>
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                <x-dropdown-link  > 
                          <a href="{{ config('app.url') }}/c/{{ $course->id }}" class="bg-white p-4 shadow-sm flex flex-col items-center" style="border-radius:22px; text-decoration: none; color: inherit;">
                                    {{ __('مشاهده') }}
</a>

                                </x-dropdown-link> 
                                    <x-dropdown-link wire:click="edit({{ $course->id }})">
                                        {{ __('مسدود کردن') }}
                                    </x-dropdown-link>
                                    
                                    <x-dropdown-link wire:click="delete({{ $course->id }})" wire:confirm="آیا از اجرا این کار بی گمانید؟"> 

                                        {{ __('پاک کردن') }}

                                    </x-dropdown-link> 
                                </x-slot>
                            </x-dropdown>
                     
                    </div>

                    <img src="{{ $course->image }}" width="200px" height="100px" >
                    <p class="mt-4 text-gray-900 font-bold">{{ $course->title }}</p>
                        <p class="mt-4 text-lg text-gray-900">{{ $course->short_data }}</p>
                        <p class="mt-4 text-lg text-gray-900">{{ $course->user_id }}</p>

                   
                 

                </div>
            </div>
        @endforeach
    </div>
