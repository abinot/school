<?php

use Livewire\Volt\Component;
use App\Models\Course;

new class extends Component {
    public $search = '';

    // استفاده از computed property با نام صحیح
    public function getCoursesProperty()
    {
        return Course::query()
            ->when($this->search, function($query) {
                $query->where('title', 'like', '%'.$this->search.'%')
                      ->orWhere('data', 'like', '%'.$this->search.'%')
                      ->orWhere('short_data', 'like', '%'.$this->search.'%');
            })
            ->orderByDesc('created_at')
            ->get();
    }
};
?>
<div x-data="{ open: false }" class="space-y-6">
    <br><hr>
    <!-- فیلد جستجو -->
    <input 
        type="text" 
        wire:model.live.debounce.300ms="search" 
        placeholder="جستجو در دوره ها..."
        class="w-full m-60 p-60 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500"
        
        x-on:focus="open = true"
        x-on:click.away="open = false"
    >

    <!-- لیست نتایج -->
    <div class="space-y-4" x-show="open">
        @forelse($this->courses as $course) <!-- تغییر به property بدون پرانتز -->
            <div class="p-4 bg-white shadow-md rounded-lg transition hover:shadow-lg">
                <h3 class="text-xl font-bold text-gray-800">{{ $course->title }}</h3>
                <p class="text-gray-600 mt-2">{{ $course->short_data }}</p>
                <div class="mt-3 flex gap-2">
                    <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">
                        {{ $course->type }}
                    </span>
                </div>
            </div>
        @empty
            <div class="p-4 text-center text-gray-500">
                موردی یافت نشد
            </div>
        @endforelse
    </div>
</div>