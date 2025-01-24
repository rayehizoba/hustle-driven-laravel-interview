<div class="bg-gray-100">
    <div class="max-w-6xl mx-auto">
        <!-- Search Input -->
        <div class="mb-4">
            <input
                type="text"
                wire:model.live.debounce.300ms="search"
                placeholder="Search..."
                class="w-full px-4 py-2 border rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
            />
        </div>

        <!-- Table -->
        <div class="bg-white shadow rounded">
            <table class="min-w-full border-collapse table-auto">
                <thead class="bg-gray-200">
                <tr>
                    <th class="border px-4 py-2 text-left">ID</th>
                    <th class="border px-4 py-2 text-left">Title</th>
                    <th class="border px-4 py-2 text-left">Status</th>
                    <th class="border px-4 py-2 text-left">Notes</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($data as $item)
                    <tr class="hover:bg-gray-100">
                        <td class="border px-4 py-2">{{ $item->id }}</td>
                        <td class="border px-4 py-2">{{ $item->title }}</td>
                        <td class="border px-4 py-2">{{ $item->status }}</td>
                        <td class="border px-4 py-2">{{ $item->notes }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center px-4 py-2">No results found.</td>
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
</div>
