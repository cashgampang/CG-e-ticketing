<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Verif Certificate') }}
        </h2>
    </x-slot>

    <div class="py-8 px-4 sm:px-0 md:px-0 lg:px-0">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow rounded-lg">
                <form action="{{ route('verif-certificates.store') }}" method="POST" class="space-y-6">
                    @csrf
                    @php
                        $inputClass =
                            'w-full p-2 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm';
                        $labelClass = 'w-64 font-semibold text-gray-700';
                        $labelTitikDua = 'w-2 font-semibold text-gray-700';
                    @endphp

                    <!-- Certified Number -->
                    <div class="flex items-center gap-4">
                        <label for="cn" class="{{ $labelClass }}">Certified Number</label>
                        <label class="{{ $labelTitikDua }}">:</label>
                        <input type="text" name="cn" id="cn" class="{{ $inputClass }}" required>
                    </div>

                    <!-- IEC -->
                    <div class="flex items-center gap-4">
                        <label for="iec" class="{{ $labelClass }}">IEC</label>
                        <label class="{{ $labelTitikDua }}">:</label>
                        <input type="text" name="iec" id="iec" class="{{ $inputClass }}" required>
                    </div>

                    <!-- Firm Name -->
                    <div class="flex items-center gap-4">
                        <label for="firm_name" class="{{ $labelClass }}">Firm Name</label>
                        <label class="{{ $labelTitikDua }}">:</label>
                        <input type="text" name="firm_name" id="firm_name" class="{{ $inputClass }}" required>
                    </div>

                    <!-- Scheme -->
                    <div class="flex items-center gap-4">
                        <label for="scheme" class="{{ $labelClass }}">Scheme</label>
                        <label class="{{ $labelTitikDua }}">:</label>
                        <input type="text" name="scheme" id="scheme" class="{{ $inputClass }}" required>
                    </div>

                    <!-- Process -->
                    <div class="flex items-center gap-4">
                        <label for="process" class="{{ $labelClass }}">Process</label>
                        <label class="{{ $labelTitikDua }}">:</label>
                        <input type="text" name="process" id="process" class="{{ $inputClass }}" required>
                    </div>

                    <!-- Date of Issue of Document -->
                    <div class="flex items-center gap-4">
                        <label for="doi_of_document" class="{{ $labelClass }}">Date of Issue</label>
                        <label class="{{ $labelTitikDua }}">:</label>
                        <input type="date" name="doi_of_document" id="doi_of_document" class="{{ $inputClass }}"
                            required>
                    </div>

                    <!-- Document Type -->
                    <div class="flex items-center gap-4">
                        <label for="doc_type" class="{{ $labelClass }}">Document Type</label>
                        <label class="{{ $labelTitikDua }}">:</label>
                        <input type="text" name="doc_type" id="doc_type" class="{{ $inputClass }}" required>
                    </div>

                    <!-- Issuing Office -->
                    <div class="flex items-center gap-4">
                        <label for="issuing_office" class="{{ $labelClass }}">Issuing Office</label>
                        <label class="{{ $labelTitikDua }}">:</label>
                        <input type="text" name="issuing_office" id="issuing_office" class="{{ $inputClass }}"
                            required>
                    </div>

                    <!-- Current Status -->
                    <div class="flex items-center gap-4">
                        <label for="current_status" class="{{ $labelClass }}">Current Status</label>
                        <label class="{{ $labelTitikDua }}">:</label>
                        <input type="text" name="current_status" id="current_status" class="{{ $inputClass }}">
                    </div>

                    <hr class="my-6">

                    <h3 class="text-lg font-semibold text-gray-700">Exporter Certificate Details</h3>

                    <!-- Application Number -->
                    <div class="flex items-center gap-4">
                        <label for="ecd_application_number" class="{{ $labelClass }}">Application Number</label>
                        <label class="{{ $labelTitikDua }}">:</label>
                        <input type="text" name="ecd_application_number" id="ecd_application_number"
                            class="{{ $inputClass }}" required>
                    </div>

                    <!-- Scheme Name -->
                    <div class="flex items-center gap-4">
                        <label for="ecd_scheme_name" class="{{ $labelClass }}">Scheme Name</label>
                        <label class="{{ $labelTitikDua }}">:</label>
                        <input type="text" name="ecd_scheme_name" id="ecd_scheme_name" class="{{ $inputClass }}"
                            required>
                    </div>

                    <!-- Exporter Name -->
                    <div class="flex items-center gap-4">
                        <label for="ecd_exporter_name" class="{{ $labelClass }}">Exporter Name</label>
                        <label class="{{ $labelTitikDua }}">:</label>
                        <input type="text" name="ecd_exporter_name" id="ecd_exporter_name"
                            class="{{ $inputClass }}" required>
                    </div>

                    <!-- Exporter Address -->
                    <div class="flex items-center gap-4">
                        <label for="ecd_exporter_address" class="{{ $labelClass }}">Exporter Address</label>
                        <label class="{{ $labelTitikDua }}">:</label>
                        <input type="text" name="ecd_exporter_address" id="ecd_exporter_address"
                            class="{{ $inputClass }}" required>
                    </div>

                    <!-- Exporter Country -->
                    <div class="flex items-center gap-4">
                        <label for="ecd_exporter_country" class="{{ $labelClass }}">Exporter Country</label>
                        <label class="{{ $labelTitikDua }}">:</label>
                        <input type="text" name="ecd_exporter_country" id="ecd_exporter_country"
                            class="{{ $inputClass }}" required>
                    </div>

                    <!-- Importer Name -->
                    <div class="flex items-center gap-4">
                        <label for="ecd_importer_name" class="{{ $labelClass }}">Importer Name</label>
                        <label class="{{ $labelTitikDua }}">:</label>
                        <input type="text" name="ecd_importer_name" id="ecd_importer_name"
                            class="{{ $inputClass }}" required>
                    </div>

                    <!-- Importer Address -->
                    <div class="flex items-center gap-4">
                        <label for="ecd_importer_address" class="{{ $labelClass }}">Importer Address</label>
                        <label class="{{ $labelTitikDua }}">:</label>
                        <input type="text" name="ecd_importer_address" id="ecd_importer_address"
                            class="{{ $inputClass }}" required>
                    </div>

                    <!-- Importer Country -->
                    <div class="flex items-center gap-4">
                        <label for="ecd_importer_country" class="{{ $labelClass }}">Importer Country</label>
                        <label class="{{ $labelTitikDua }}">:</label>
                        <input type="text" name="ecd_importer_country" id="ecd_importer_country"
                            class="{{ $inputClass }}" required>
                    </div>

                    <!-- Status -->
                    <div class="flex items-center gap-4">
                        <label for="ecd_status" class="{{ $labelClass }}">Status</label>
                        <label class="{{ $labelTitikDua }}">:</label>
                        <input type="text" name="ecd_status" id="ecd_status" class="{{ $inputClass }}"
                            required>
                    </div>

                    <!-- Optional Fields -->
                    <div class="flex items-center gap-4">
                        <label for="ecd_means_of_transport_and_route" class="{{ $labelClass }}">Transport and
                            Route</label>
                        <label class="{{ $labelTitikDua }}">:</label>
                        <input type="text" name="ecd_means_of_transport_and_route"
                            id="ecd_means_of_transport_and_route" class="{{ $inputClass }}">
                    </div>

                    <div class="flex items-center gap-4">
                        <label for="ecd_invoice_details" class="{{ $labelClass }}">Invoice Details</label>
                        <label class="{{ $labelTitikDua }}">:</label>
                        <input type="text" name="ecd_invoice_details" id="ecd_invoice_details"
                            class="{{ $inputClass }}" required>
                    </div>

                    <div class="flex items-center gap-4">
                        <label for="ecd_application_file_by" class="{{ $labelClass }}">Application Filed By</label>
                        <label class="{{ $labelTitikDua }}">:</label>
                        <input type="text" name="ecd_application_file_by" id="ecd_application_file_by"
                            class="{{ $inputClass }}" required>
                    </div>

                    <div class="flex items-center gap-4">
                        <label for="ecd_place_of_authorised_signatory" class="{{ $labelClass }}">Place of
                            Signatory</label>
                        <label class="{{ $labelTitikDua }}">:</label>
                        <input type="text" name="ecd_place_of_authorised_signatory"
                            id="ecd_place_of_authorised_signatory" class="{{ $inputClass }}" required>
                    </div>

                    <div class="flex items-center gap-4">
                        <label for="ecd_certified_issued_by" class="{{ $labelClass }}">Certified Issued By</label>
                        <label class="{{ $labelTitikDua }}">:</label>
                        <input type="text" name="ecd_certified_issued_by" id="ecd_certified_issued_by"
                            class="{{ $inputClass }}" required>
                    </div>

                    <div class="flex items-center gap-4">
                        <label for="ecd_place_of_certifying_authority" class="{{ $labelClass }}">Place of
                            Certifying Authority</label>
                        <label class="{{ $labelTitikDua }}">:</label>
                        <input type="text" name="ecd_place_of_certifying_authority"
                            id="ecd_place_of_certifying_authority" class="{{ $inputClass }}" required>
                    </div>

                    <div class="flex items-center gap-4">
                        <label for="ecd_certified_issuing_agency" class="{{ $labelClass }}">Certified Issuing
                            Agency</label>
                        <label class="{{ $labelTitikDua }}">:</label>
                        <input type="text" name="ecd_certified_issuing_agency" id="ecd_certified_issuing_agency"
                            class="{{ $inputClass }}" required>
                    </div>

                    <div class="flex items-center gap-4">
                        <label for="ecd_certified_issued_on" class="{{ $labelClass }}">Certified Issued On</label>
                        <label class="{{ $labelTitikDua }}">:</label>
                        <input type="date" name="ecd_certified_issued_on" id="ecd_certified_issued_on"
                            class="{{ $inputClass }}" required>
                    </div>

                    <div class="flex items-center gap-4">
                        <label for="ecd_certified_country_of_origin" class="{{ $labelClass }}">Country of
                            Origin</label>
                        <label class="{{ $labelTitikDua }}">:</label>
                        <input type="text" name="ecd_certified_country_of_origin"
                            id="ecd_certified_country_of_origin" class="{{ $inputClass }}" required>
                    </div>

                    <div class="flex justify-between pt-4">
                        <a href="{{ route('dashboard') }}"
                            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 text-sm">Kembali</a>
                        <button type="submit"
                            class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 text-sm">Submit</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
