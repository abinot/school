<?php

 

use App\Models\Course; 

use Livewire\Attributes\Validate; 

use Livewire\Volt\Component;

 

new class extends Component

{

    public Course $course; 

 

    #[Validate('required|max:5000')]
    public string $data = '';

    #[Validate('required|string|max:50')]
    public string $title = '';

    #[Validate('required|string|max:255')]
    public string $image = '';

    public $show = 0;

 

    public function mount(): void

    {
        $this->title = $this->course->title;
        $this->image = $this->course->image;
        $this->data = $this->course->data;
        $this->show = $this->course->show;

    }

 

    public function update(): void

    {

        $this->authorize('update', $this->course);

 

        $validated = $this->validate();

 

        $this->course->update($validated);

 

        $this->dispatch('course-updated');

    }

 

    public function cancel(): void

    {

        $this->dispatch('course-edit-canceled');

    }  

}; ?>

 

<div>



    <form wire:submit="update"> 

    <input wire:model="image" id="image"   placeholder="{{ __('لینک نگاره') }}"  class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">

    <input wire:model="title" id="title"   placeholder="{{ __('نام دوره') }}"  class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
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