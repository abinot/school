<?php

use App\Models\Data;
use Livewire\Attributes\On;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Volt\Component;

new class extends Component
{
    public Collection $data_s;

    public ?data $editing = null;
    public function delete(Data $data): void

    {
        $this->authorize('delete', $data);
        $data->delete();
        $this->getData();
    }
    public function mount(): void
    {
        $this->getData();
    }
    #[On('data-created')]
    public function getData(): void
    {
        $this->data_s = \App\Models\Data::with('user')
            ->where('user_id', Auth::id()) 
            ->latest()
            ->get();
    }
    public function edit(Data $data): void
    {
        $this->editing = $data;

        $this->getData();
    }
    #[On('data-edit-canceled')]

    #[On('data-updated')] 

    public function disableEditing(): void

    {

        $this->editing = null;

 

        $this->getData();

    } 

}; ?>

<div>
    <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
        @foreach ($data_s as $data)
            <div class="p-6 flex space-x-2" wire:key="{{ $data->id }}">
                <div class="flex-1">
                    <div class="flex justify-between items-center">
                        <div>

                            <small class="ml-2 text-sm text-gray-600">{{ $data->created_at->format('j M Y, g:i a') }}</small>
                            @unless ($data->created_at->eq($data->updated_at))
                                <small class="text-sm text-gray-600"> &middot; {{ __('edited') }}</small>
                            @endunless
                        </div>
                        @if ($data->user->is(auth()->user()))
                            <x-dropdown>
                                <x-slot name="trigger">
                                    <button>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                        </svg>
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    <x-dropdown-link wire:click="edit({{ $data->id }})">
                                        {{ __('ویرایش') }}
                                    </x-dropdown-link>
                                    <x-dropdown-link wire:click="delete({{ $data->id }})" wire:confirm="آیا از اجرا این کار بی گمانید؟"> 

                                        {{ __('پاک کردن') }}

                                    </x-dropdown-link> 
                                </x-slot>
                            </x-dropdown>
                        @endif
                    </div>
                    <p class="mt-4 text-gray-900 font-bold">{{ $data->key }}</p>
                 
                    @if ($data->is($editing))
                        <livewire:data.edit :data="$data" :key="$data->id" />
                    @else
                        <p class="mt-4 text-lg text-gray-900">{{ $data->value }}</p>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
