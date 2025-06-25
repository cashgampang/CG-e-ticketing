<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('QR Code Sertifikat') }}
        </h2>
    </x-slot>

    <div class="py-8 min-h-[85vh] flex items-start justify-center px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow-md rounded-lg p-5 sm:p-8 w-full max-w-lg text-center">

            <h2 class="text-xl sm:text-2xl font-semibold text-gray-700 text-center mb-4">QR Code Sertifikat</h2>

            @if (session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-800 rounded text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <img src="{{ $qrImage }}" alt="QR Code" class="mx-auto mb-4 max-w-full w-60 sm:w-72">

            <p class="text-gray-600 mb-1 text-sm sm:text-base">Link Sertifikat:</p>
            <a href="{{ $url }}" target="_blank"
                class="text-blue-600 hover:underline break-words text-sm sm:text-base">
                {{ $url }}
            </a>

            <div class="mt-5 flex flex-col sm:flex-row gap-3 justify-center">
                <a href="{{ route('dashboard') }}"
                    class="bg-blue-600 text-white text-center text-sm sm:text-base px-4 py-2 rounded hover:bg-blue-700 text-sm">
                    Kembali
                </a>
                <a href="{{ $qrImage }}" download="qr-{{ $certificate->UDIN }}.png"
                    class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 text-sm sm:text-base text-center">
                    Download QR Code
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
