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
            ->where('user_id', Auth::id()) 
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

<div class="container mx-auto p-4">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach ($courses as $course)
            <div class="bg-white p-4 shadow-sm flex flex-col items-center" style="border-radius:22px;">
                <div class="w-full aspect-w-2 aspect-h-1">
                    <img src="{{ $course->image }}" alt="{{ $course->title }}" style="border-radius: 18px;" class="w-full h-full object-cover rounded-[18px]">
                </div>
                <p class="mt-4 text-gray-900 font-bold text-center">{{ $course->title }}</p>
                <p class="mt-4 text-lg text-gray-900 text-center">{{ $course->short_data }}</p>
            </div>
        @endforeach
    </div>
</div>
