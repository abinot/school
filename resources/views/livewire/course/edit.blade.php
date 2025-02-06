<?php

 

use App\Models\Course; 

use Livewire\Attributes\Validate; 

use Livewire\Volt\Component;

 

new class extends Component

{

    public Course $post;

 

    #[Validate('required|max:5000')]
    public $data = '';

    #[Validate('required|string|max:50')]
    public string $title = '';

    #[Validate('required|string|max:100')]
    public string $short_data = '';

    #[Validate('required|string|max:255')]
    public string $image = '';

    public $show = 0;

 

    public function mount(): void

    {
        $this->title = $this->post->title;
        $this->image = $this->post->image;
        $this->data = $this->post->data;
        $this->short_data = $this->post->short_data;
        $this->show = $this->post->show;

    }

 

    public function update(): void

    {

        $this->authorize('update', $this->post);

 

        $validated = $this->validate();

 

        $this->post->update($validated);

 

        $this->dispatch('post-updated');

    }

 

    public function cancel(): void

    {

        $this->dispatch('post-edit-canceled');

    }  

}; ?>

 

<div>



    <form wire:submit="update"> 

    <input wire:model="image" id="image"   placeholder="{{ __('لینک نگاره') }}"  class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
<br>
    <input wire:model="title" id="title"   placeholder="{{ __('نام دوره') }}"  class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
   <br>
    <input wire:model="short_data" id="short_data"   placeholder="{{ __('متن کوتاه') }}"  class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
    <br>
        <textarea

            wire:model="data"

            placeholder="{{ __('متن') }}"

            class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"

        ></textarea>

        <x-input-error for="data" class="mt-2" />
        <x-input-error for="image" class="mt-2" />
        <x-input-error for="title" class="mt-2" />

        <x-button class="mt-4">{{ __('بازنویسی') }}</x-button>

        <button class="mt-4" wire:click.prevent="cancel">برگشت</button>

    </form> 

</div>