<?php

use App\Models\Course;
use App\Models\Ad;
use Livewire\Attributes\On;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Volt\Component;

new class extends Component
{
    public Collection $posts;
    public Collection $ads;

    public function mount(): void
    {
        $this->getPosts();
    }
    public function getPosts(): void
    {
        $this->posts = \App\Models\Course::with('user') 
            ->latest()
            ->get();
    }
    // get post_id from "Ad" and get post_id data from "post" and show it the go to next post_id on Ad
 




 

}; ?>

<div class="container mx-auto p-4">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach ($posts as $post)
            <a href="{{ config('app.url') }}/c/{{ $post->id }}" class="bg-white p-4 shadow-sm flex flex-col items-center" style="border-radius:22px; text-decoration: none; color: inherit;">
                <div class="w-full aspect-w-2 aspect-h-1">
                    <img src="{{ $post->image }}" alt="{{ $post->title }}" style="border-radius: 18px;" class="w-full h-full object-cover rounded-[18px]">
                </div>
                <p class="mt-4 text-gray-900 font-bold text-center">{{ $post->title }}</p>
                <p class="mt-4 text-lg text-gray-900 text-center">{{ $post->short_data }}</p>
            </a>
        @endforeach
    </div>
</div>
