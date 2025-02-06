<?php

use Livewire\Attributes\Validate;

use Livewire\Volt\Component; 

new class extends Component

{

    #[Validate('required|max:5000')]
    public string $data = '';

    #[Validate('required|string|max:50')]
    public string $title = '';

    #[Validate('required|string|max:255')]
    public string $image = '';

    #[Validate('required|string|max:100')]
    public string $short_data = '';

    public $show = 0;


    public function store(): void

    {

        $validated = $this->validate();

        auth()->user()->course()->create($validated);

        $this->data = '';
        $this->image = '';
        $this->title = '';
        $this->short_data = '';
        $this->show = 0;
        $this->dispatch('post-created'); 
        $this->show = 0;

    } 

}; ?> 

<div>

    <form wire:submit="store">
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
        <x-input-error for="short_data" class="mt-2" />
        <x-input-error for="image" class="mt-2" />
        <x-input-error for="title" class="mt-2" />

        <x-button class="mt-4">{{ __('افزودن') }}</x-button>

    </form>

</div>