<?php

use App\Models\Course;
use Livewire\Attributes\On;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Volt\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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
        session_start();
        $url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $path = parse_url($url, PHP_URL_PATH);
        $lastSegment = trim(basename($path));
    
        if (is_numeric($lastSegment)) {
            // If $lastSegment is a number, consider it as an ID
            $this->courses = \App\Models\Course::where('id', $lastSegment)->get();
        } else {
            // If $lastSegment is not a number, consider it as a title
            $this->courses = \App\Models\Course::where('title', $lastSegment)->get();
        }
        if ($this->courses->isEmpty()) {
            abort(404);
        }
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
   

    
    public function register(int $courseId): void
    {
        if (!Auth::check()) {
            session()->flash('error', 'برای ثبت‌نام باید وارد سیستم شوید.');
            return;
        }
    
        $user = Auth::user();
    
        if ($user->reg_courses()->where('course_id', $courseId)->exists()) {
            session()->flash('error', 'شما قبلاً در این دوره ثبت‌نام کرده‌اید!');
            return;
        }
    
        $user->reg_courses()->attach($courseId);
        redirect()->to(URL::to('/welcome?type=course&id='.$courseId));


        




        
    }


 

}; ?>
<div class="min-h-screen bg-gray-100 py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                @foreach ($courses as $course)
                    <div class="mb-8" wire:key="{{ $course->id }}">
                        <div class="flex justify-between items-center mb-4">
                            @if ($course->user->is(auth()->user()))
                                <!-- Dropdown for Edit/Delete -->
                            @endif
                        </div>
                        @if ($course->is($editing))
                            <livewire:course.edit :course="$course" :key="$course->id" />
                        @else
                            <img src="{{ $course->image }}" width="700px" height="350px" class="mb-4">
                            <p class="mt-4 text-gray-900 font-bold text-2xl">{{ $course->title }}</p>
                            <p class="mt-4 text-lg text-gray-900">{{ $course->short_data }}</p>
                            <br>
                            <hr><hr>
                            <br>
                            <div class="prose md">
                                {!! Str::markdown($course->data) !!}
                            </div>

                            <!-- دکمه ثبت‌نام -->
                            <button wire:click="register({{ $course->id }})" class="bg-blue-500 text-white px-4 py-2 rounded mt-4">
                                نام نویسی در دوره
                            </button>

                            <!-- نمایش پیام‌ها -->
                            @if (session('message'))
                                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mt-4">
                                    {{ session('message') }}
                                </div>
                            @endif
                            @if (session('error'))
                                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mt-4">
                                    {{ session('error') }}
                                </div>
                            @endif
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    





</div>