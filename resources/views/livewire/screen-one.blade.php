<div class="max-w-6xl mx-auto">
    <!-- Search Input -->
    <div class="mb-4">
        <input
            type="text"
            wire:model.live.debounce.300ms="search"
            placeholder="Search..."
            class="w-full px-4 py-2 border rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-slate-800 dark:border-slate-600 dark:text-slate-300"
        />
    </div>

    <!-- Table -->
    <div class="dark:bg-slate-800 shadow overflow-hidden dark:text-slate-300">
        <table class="min-w-full border-collapse table-auto">
            <thead class="bg-gray-200 dark:bg-slate-700">
            <tr>
                <th class="border dark:border-slate-600 px-4 py-2 text-left">ID</th>
                <th class="border dark:border-slate-600 px-4 py-2 text-left">Title</th>
                <th class="border dark:border-slate-600 px-4 py-2 text-left">Status</th>
                <th class="border dark:border-slate-600 px-4 py-2 text-left">Notes</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($data as $item)
                <tr class="hover:bg-gray-100 dark:hover:bg-slate-900">
                    <td class="border dark:border-slate-600 px-4 py-2">{{ $item->id }}</td>
                    <td class="border dark:border-slate-600 px-4 py-2">{{ $item->title }}</td>
                    <td class="border dark:border-slate-600 px-4 py-2">{{ $item->status }}</td>
                    <td class="border dark:border-slate-600 px-4 py-2">{{ $item->notes }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="border dark:border-slate-600 text-center px-4 py-2">No results found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $data->links() }}
    </div>
</div>
