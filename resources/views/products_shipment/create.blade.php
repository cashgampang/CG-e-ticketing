<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Product Shipment') }}
        </h2>
    </x-slot>

    <div class="py-8 px-4">
        <div class="max-w-7xl mx-auto space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow rounded-lg">
                <form action="{{ route('products-shipment.store') }}" method="POST" class="space-y-6">
                    @csrf
                    @php
                        $inputClass =
                            'w-full p-2 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm';
                        $labelClass = 'w-64 font-semibold text-gray-700';
                        $labelTitikDua = 'w-2 font-semibold text-gray-700';
                    @endphp

                    <div class="flex items-center gap-4">
                        <label class="{{ $labelClass }}">Verif Certificate</label>
                        <label class="{{ $labelTitikDua }}">:</label>
                        <select name="verif_certificate_id" class="{{ $inputClass }}" required>
                            @if (Cookie::get('verif_certificate_id'))
                                <option value="{{ Cookie::get('verif_certificate_id') }}" selected>
                                    {{ Cookie::get('verif_certificate_id') }}
                                </option>
                            @else
                                <option value="">-- No Certificate Found --</option>
                            @endif
                        </select>
                    </div>

                    <div id="productFormsContainer">
                        <div class="product-form space-y-4 p-4 mb-6 border border-gray-200 rounded-md bg-gray-50">
                            <div class="flex items-center gap-4">
                                <label class="{{ $labelClass }}">Marks & Number of Packages</label>
                                <label class="{{ $labelTitikDua }}">:</label>
                                <textarea name="products[0][marks_and_number_of_packages]" class="{{ $inputClass }}" required></textarea>
                            </div>

                            <div class="flex items-center gap-4">
                                <label class="{{ $labelClass }}">Number & Kind of Packages</label>
                                <label class="{{ $labelTitikDua }}">:</label>
                                <textarea name="products[0][number_and_kind_of_packages]" class="{{ $inputClass }}" required></textarea>
                            </div>

                            <div class="flex items-center gap-4">
                                <label class="{{ $labelClass }}">Description of Goods</label>
                                <label class="{{ $labelTitikDua }}">:</label>
                                <textarea name="products[0][description_of_goods]" class="{{ $inputClass }}" required></textarea>
                            </div>

                            <div class="flex items-center gap-4">
                                <label class="{{ $labelClass }}">Origin Criterion</label>
                                <label class="{{ $labelTitikDua }}">:</label>
                                <input type="text" name="products[0][origin_criterion]" class="{{ $inputClass }}"
                                    required>
                            </div>

                            <div class="flex items-center gap-4">
                                <label class="{{ $labelClass }}">Gross Weight/Qty</label>
                                <label class="{{ $labelTitikDua }}">:</label>
                                <input type="text" name="products[0][gross_weight_or_other_quantity]"
                                    class="{{ $inputClass }}" required>
                            </div>

                            <div class="flex justify-end">
                                <button type="button" class="remove-product text-red-600 hover:text-red-800 text-sm">🗑
                                    Hapus Produk</button>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-between items-center">
                        <button type="button" id="addProduct"
                            class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 text-sm">
                            + Tambah Produk
                        </button>
                        <button type="submit"
                            class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 text-sm">
                            Simpan Semua Produk
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let productIndex = 1;

        document.getElementById('addProduct').addEventListener('click', function() {
            const container = document.getElementById('productFormsContainer');
            const newForm = document.querySelector('.product-form').cloneNode(true);

            newForm.querySelectorAll('textarea, input').forEach(function(el) {
                const name = el.getAttribute('name');
                const newName = name.replace(/\d+/, productIndex);
                el.setAttribute('name', newName);
                el.value = '';
            });

            container.appendChild(newForm);
            productIndex++;
        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-product')) {
                const allForms = document.querySelectorAll('.product-form');
                if (allForms.length > 1) {
                    e.target.closest('.product-form').remove();
                } else {
                    alert('Minimal satu produk harus diisi.');
                }
            }
        });
    </script>
</x-app-layout>
