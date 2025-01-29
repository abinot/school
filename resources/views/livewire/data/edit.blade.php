<?php



use App\Models\Data; 

use Livewire\Attributes\Validate; 

use Livewire\Volt\Component;



new class extends Component

{

    public Data $data; 



    #[Validate('required|string|max:255')]

    public string $value = '';

 


    public function mount(): void
    {
        
        logger($this->data);
    
        $this->value = $this->data->value ?? '';
    }

 

    public function update(): void

    {

        $this->authorize('update', $this->data);

 

        $validated = $this->validate();

 

        $this->data->update($validated);

 

        $this->dispatch('data-updated');

    }

 

    public function cancel(): void

    {

        $this->dispatch('data-edit-canceled');

    }  

}; ?>

 

<div>

    
    <form wire:submit="update"> 

        <textarea

            wire:model="value"

            class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"

        ></textarea>

 

        <x-input-error for="value" :values="$errors->get('value')" class="mt-2" />

        <x-button class="mt-4">{{ __('بازنویسی') }}</x-button>

        <button class="inline-flex items-center px-4 py-2  border border-transparent rounded-md font-semibold text-xs text-black uppercase tracking-widest hover:bg-gray-550 focus:bg-gray-550 active:bg-gray-570 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150 mt-4"  wire:click.prevent="cancel">بازگشت</button>

    </form> 

</div>