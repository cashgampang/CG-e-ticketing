<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Product Shipment') }}
        </h2>
    </x-slot>

    <div class="py-8 px-4">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-6 bg-white shadow rounded-lg">
                <form action="{{ route('products-shipment.update', $shipment->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    @php
                        $inputClass =
                            'w-full p-2 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm';
                        $labelClass = 'w-64 font-semibold text-gray-700';
                        $labelTitikDua = 'w-2 font-semibold text-gray-700';
                    @endphp

                    <div class="flex flex-col gap-1">
                        <div class="flex items-start gap-4">
                            <label for="marks_and_number_of_packages" class="{{ $labelClass }}">Marks & Number of
                                Packages</label>
                            <label class="{{ $labelTitikDua }}">:</label>
                            <textarea name="marks_and_number_of_packages" id="marks_and_number_of_packages" rows="3"
                                class="{{ $inputClass }}" required>{{ $shipment->marks_and_number_of_packages }}</textarea>
                        </div>
                    </div>

                    <div class="flex flex-col gap-1">
                        <div class="flex items-start gap-4">
                            <label for="number_and_kind_of_packages" class="{{ $labelClass }}">Number & Kind of
                                Packages</label>
                            <label class="{{ $labelTitikDua }}">:</label>
                            <textarea name="number_and_kind_of_packages" id="number_and_kind_of_packages" rows="3" class="{{ $inputClass }}"
                                required>{{ $shipment->number_and_kind_of_packages }}</textarea>
                        </div>
                    </div>

                    <div class="flex flex-col gap-1">
                        <div class="flex items-start gap-4">
                            <label for="description_of_goods" class="{{ $labelClass }}">Description of Goods</label>
                            <label class="{{ $labelTitikDua }}">:</label>
                            <textarea name="description_of_goods" id="description_of_goods" rows="3" class="{{ $inputClass }}" required>{{ $shipment->description_of_goods }}</textarea>
                        </div>
                    </div>

                    <div class="flex items-center gap-4">
                        <label for="origin_criterion" class="{{ $labelClass }}">Origin Criterion</label>
                        <label class="{{ $labelTitikDua }}">:</label>
                        <input type="text" name="origin_criterion" id="origin_criterion" class="{{ $inputClass }}"
                            value="{{ $shipment->origin_criterion }}" required>
                    </div>

                    <div class="flex items-center gap-4">
                        <label for="gross_weight_or_other_quantity" class="{{ $labelClass }}">Gross Weight or
                            Quantity</label>
                        <label class="{{ $labelTitikDua }}">:</label>
                        <input type="text" name="gross_weight_or_other_quantity" id="gross_weight_or_other_quantity"
                            class="{{ $inputClass }}" value="{{ $shipment->gross_weight_or_other_quantity }}"
                            required>
                    </div>

                    <div class="flex justify-between pt-4">
                        <a href="{{ route('products-shipment.index') }}"
                            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 text-sm">Kembali</a>
                        <button type="submit"
                            class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 text-sm">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
