<?php

use Livewire\Attributes\Validate;

use Livewire\Volt\Component; 

new class extends Component

{

    #[Validate('required|max:5000')]
    public string $data = '';

    #[Validate('required|string|max:50')]
    public string $title = '';

    #[Validate('required|string|in:course,link,post,ad')]
    public string $type = '';


    #[Validate('required|string|max:255')]
    public string $image = '';

    #[Validate('string|max:255')]
    public string $button1 = '';

    #[Validate('string|max:255')]
    public string $button2 = '';

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
        $this->type = "";
        $this->dispatch('post-created'); 
        $this->show = 0;

    } 

}; ?> 
<div>
<div class="p-6 bg-white rounded-lg shadow-md">

<form wire:submit="store" class="space-y-4">
    <input 
        wire:model="image" 
        id="image"   
        placeholder="{{ __('لینک نگاره') }}"  
        class="block w-full border border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm p-2"
    >
    
    <input 
        wire:model="title" 
        id="title"   
        placeholder="{{ __('نام دوره') }}"  
        class="block w-full border border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm p-2"
    >
    
    <input 
        wire:model="short_data" 
        id="short_data" 
        placeholder="{{ __('متن کوتاه') }}" 
        class="block w-full border border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm p-2"
    >
    <br>
   
        <span class="font-semibold">{{ __('گونه') }}</span>
        <div class="flex items-center">
            <input 
                wire:model="type" 
                id="type_course" 
                value="course" 
                name="type" 
                type="radio" 
                class="mr-2"
            >
            <label for="type_c" class="cursor-pointer">{{ __('دوره') }}</label>
        </div>

        <div class="flex items-center">
            <input 
                wire:model="type" 
                id="type_post" 
                value="post" 
                name="type" 
                type="radio" 
                class="mr-2"
            >
            <label for="type_p" class="cursor-pointer">{{ __('فرسته') }}</label>
        </div>
        <div class="flex items-center">
            <input 
                wire:model="type" 
                id="type_link" 
                value="link" 
                name="type" 
                type="radio" 
                class="mr-2"
            >
            <label for="type_l" class="cursor-pointer">{{ __('پیوند') }}</label>
        </div>
        <div class="flex items-center">
            <input 
                wire:model="type" 
                id="type_ad" 
                value="ad" 
                name="type" 
                type="radio" 
                class="mr-2"
            >
            <label for="type_a" class="cursor-pointer">{{ __('آگهی') }}</label>
        </div>
  

        <input 
        wire:model="button1" 
        id="button1"   
        placeholder="{{ __('دکمه 1') }}"  
        class="block w-full border border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm p-2"
    >
    <p style="color:gray;">اگر خالی بگذارید دکمه پیشفرض نشان داده میشود</p>
    <br>
    <input 
        wire:model="button2" 
        id="button2"   
        placeholder="{{ __('دکمه 2') }}"  
        class="block w-full border border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm p-2"
    >
    
    <p style="color:gray;">اگر خالی بگذارید دکمه نشان داده نمیشود</p>
    <br>

    <textarea
        wire:model="data"
        placeholder="{{ __('متن') }}"
        class="block w-full border border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm p-2"
    ></textarea>

    <x-input-error for="data" class="mt-2" />
    <x-input-error for="short_data" class="mt-2" />
    <x-input-error for="image" class="mt-2" />
    <x-input-error for="title" class="mt-2" />
    <x-input-error for="type" class="mt-2" />
    <x-input-error for="button1" class="mt-2" />
    <x-input-error for="button2" class="mt-2" />
    <x-button class="mt-4">{{ __('افزودن') }}</x-button>
</form>

</div>
</div>