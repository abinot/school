<?php

use App\Models\Course;
use Livewire\Attributes\On;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Volt\Component;

new class extends Component
{
    public Collection $posts;

    public ?Course $editing = null;
    public function delete(Course $post): void

    {
        $this->authorize('delete', $post);
        $post->delete();
        $this->getPost();
    }
    public function mount(): void
    {
        $this->getPost();
    }
    #[On('post-created')]
    public function getPost(): void
    {
        $this->posts = \App\Models\Course::with('user')
            ->where('user_id', Auth::id()) 
            ->latest()
            ->get();
    }
    public function edit(course $post): void
    {
        $this->editing = $post;

        $this->getPost();
    }
    #[On('post-edit-canceled')]

    #[On('post-updated')] 

    public function disableEditing(): void

    {

        $this->editing = null;

 

        $this->getPost();

    } 



 

}; ?>

<div>
    <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
        @foreach ($posts as $post)
        
            <div class="p-6 flex space-x-2" wire:key="{{ $post->id }}">
                <div class="flex-1">
                    <div class="flex justify-between items-center">
                        <div>

                            <small class="ml-2 text-sm text-gray-600">{{ $post->created_at->format('j M Y, g:i a') }}</small>

                        </div>
                        @if ($post->user->is(auth()->user()))
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
                          <a href="{{ config('app.url') }}/c/{{ $post->id }}" class="bg-white p-4 shadow-sm flex flex-col items-center" style="border-radius:22px; text-decoration: none; color: inherit;">
                                    {{ __('مشاهده') }}
</a>

                                </x-dropdown-link> 
                                    <x-dropdown-link wire:click="edit({{ $post->id }})">
                                        {{ __('ویرایش') }}
                                    </x-dropdown-link>
                                    
                                    <x-dropdown-link wire:click="delete({{ $post->id }})" wire:confirm="آیا از اجرا این کار بی گمانید؟"> 

                                        {{ __('پاک کردن') }}

                                    </x-dropdown-link> 
                                </x-slot>
                            </x-dropdown>
                        @endif
                    </div>
                   
                 
                    @if ($post->is($editing))
                        <livewire:post.edit :post="$post" :key="$post->id" />
                    @else
                    <img src="{{ $post->image }}" width="200px" height="100px" >
                    <p class="mt-4 text-gray-900 font-bold">{{ $post->title }}</p>
                        <p class="mt-4 text-lg text-gray-900">{{ $post->short_data }}</p>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
