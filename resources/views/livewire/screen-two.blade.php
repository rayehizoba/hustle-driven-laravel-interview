<div class="max-w-6xl mx-auto h-full">
    <!-- Search Input -->
    <div class="mb-4">
        <input
            type="text"
            wire:model="search"
            wire:keydown.enter="handleSearch"
            placeholder="Search..."
            class="w-full px-4 py-2 border rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-slate-800 dark:border-slate-600 dark:text-slate-300"
        />
    </div>

    @empty($photoUrl)
        <div class="text-center text-gray-500">
            No photos available. Try searching for something else.
        </div>
    @endempty

    @isset($photoUrl)
        <div class="h-[90%] flex items-center -space-x-10">
            <button
                wire:click="handlePrevious"
                wire:loading.target="handlePrevious"
                wire:loading.class="animate-pulse !scale-[0.9]"
                class="text-9xl text-blue-500 relative active:scale-[0.9] transform transition-all hover:scale-[1.1]"
                aria-label="Previous Photo"
            >
                <i class="mdi mdi-arrow-left-bold"></i>
            </button>
            <div class="h-full w-full bg-contain bg-center bg-no-repeat" style="background-image: url({{ $photoUrl }})">
            </div>
            <button
                wire:click="handleNext"
                wire:loading.target="handleNext"
                wire:loading.class="animate-pulse !scale-[0.9]"
                class="text-9xl text-blue-500 active:scale-[0.9] transform transition-all hover:scale-[1.1]"
                aria-label="Next Photo"
            >
                <i class="mdi mdi-arrow-right-bold"></i>
            </button>
        </div>
    @endisset
</div>
