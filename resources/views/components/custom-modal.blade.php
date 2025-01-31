@props(['id' => null, 'maxWidth' => null])

<div x-data="{ isOpen: false }" 
     x-show="isOpen" 
     @open-modal.window="isOpen = true"
     @close-modal.window="isOpen = false"
     @keydown.escape.window="isOpen = false"
     class="fixed inset-0 z-50 flex items-center justify-center p-4"
     style="display: none;">
    <!-- Background -->
    <div class="fixed inset-0 bg-black/50"></div>

    <!-- Modal Content -->
    <div class="bg-white rounded-lg overflow-hidden shadow-xl w-full {{ $maxWidth ? 'max-w-'.$maxWidth : 'max-w-md' }}">
        <div class="p-6">
            <h3 class="text-xl font-bold" id="modalTitle">{{ $title }}</h3>
            <div class="mt-4" id="modalMessage">{{ $content }}</div>
        </div>
        <div class="bg-gray-100 px-6 py-4 flex justify-end gap-3">
            {{ $footer }}
        </div>
    </div>
</div>