<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Merk') }}
        </h2>
    </x-slot>

    <div class="py-8 px-4 sm:px-0 md:px-0 lg:px-0">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow rounded-lg">
                <div class="flex flex-row flex-wrap justify-between items-center gap-2 mb-6">
                    <h2 class="text-xl sm:text-2xl font-semibold text-gray-700">Verif Certificates</h2>
                    <a href="{{ route('verif-certificates.create') }}"
                        class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 text-sm sm:text-base">
                        Add New
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
                    <table class="min-w-full table-auto text-sm text-left">
                        <thead class="bg-gray-200">
                            <tr class="text-center">
                                <th class="p-2">UDIN</th>
                                <th class="p-2">CN</th>
                                <th class="p-2">IEC</th>
                                <th class="p-2">Firm</th>
                                <th class="p-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($certificates as $cert)
                                <tr class="border-b hover:bg-gray-50 text-center">
                                    <td class="p-2">{{ $cert->UDIN }}</td>
                                    <td class="p-2">{{ $cert->cn }}</td>
                                    <td class="p-2">{{ $cert->iec }}</td>
                                    <td class="p-2">{{ $cert->firm_name }}</td>
                                    <td
                                        class="p-2 space-y-1 sm:space-y-0 sm:space-x-2 flex flex-col sm:flex-row justify-center items-center">
                                        <a href="{{ route('certificates.qr', $cert->UDIN) }}"
                                            class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 text-xs sm:text-sm">
                                            Show QR
                                        </a>
                                        <a href="{{ route('products-shipment.index', ['verif_certificate_id' => $cert->id]) }}"
                                            class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 text-xs sm:text-sm">
                                            Lihat Produk
                                        </a>
                                        <a href="{{ route('verif-certificates.edit', $cert->id) }}"
                                            class="bg-indigo-600 text-white px-3 py-1 rounded hover:bg-indigo-700 text-xs sm:text-sm">
                                            Edit
                                        </a>
                                        <form action="{{ route('verif-certificates.destroy', $cert->id) }}"
                                            method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 text-xs sm:text-sm">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
