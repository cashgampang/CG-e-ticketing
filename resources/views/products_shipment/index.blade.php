<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product Shipments') }}
        </h2>
    </x-slot>

    <div class="py-8 px-4">
        <div class="max-w-7xl mx-auto space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow rounded-lg">
                <div class="flex flex-row flex-wrap justify-between items-center gap-2 mb-6">
                    <h2 class="text-xl sm:text-2xl font-semibold text-gray-700">Product Shipments</h2>
                    <a href="{{ route('dashboard') }}"
                        class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 text-sm sm:text-base">
                        Kembali
                    </a>
                </div>

                @if (session('success'))
                    <div class="mb-4 p-3 bg-green-100 text-green-800 rounded text-sm">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('info'))
                    <div class="mb-4 p-3 bg-blue-100 text-blue-800 rounded text-sm">
                        {{ session('info') }}
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto text-sm text-left border border-gray-200">
                        <thead class="bg-gray-100">
                            <tr class="text-center text-gray-700">
                                <th class="p-3 border-b">Certificate ID</th>
                                <th class="p-3 border-b">Marks</th>
                                <th class="p-3 border-b">Description</th>
                                <th class="p-3 border-b">Weight</th>
                                <th class="p-3 border-b">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($shipments as $item)
                                <tr class="border-b hover:bg-gray-50 text-center">
                                    <td class="p-3">{{ $item->verif_certificate_id }}</td>
                                    <td class="p-3">{{ $item->marks_and_number_of_packages }}</td>
                                    <td class="p-3">{{ $item->description_of_goods }}</td>
                                    <td class="p-3">{{ $item->gross_weight_or_other_quantity }}</td>
                                    <td class="p-3">
                                        <div
                                            class="flex flex-col sm:flex-row sm:space-x-2 space-y-1 sm:space-y-0 justify-center items-center">
                                            {{-- <a href="{{ route('products-shipment.show', $item->id) }}"
                                                class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 text-xs sm:text-sm">
                                                View
                                            </a> --}}
                                            <a href="{{ route('products-shipment.edit', $item->id) }}"
                                                class="bg-indigo-600 text-white px-3 py-1 rounded hover:bg-indigo-700 text-xs sm:text-sm">
                                                Edit
                                            </a>
                                            <form action="{{ route('products-shipment.destroy', $item->id) }}"
                                                method="POST" onsubmit="return confirm('Are you sure?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 text-xs sm:text-sm">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="p-3 text-center text-gray-500">No product shipments found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
