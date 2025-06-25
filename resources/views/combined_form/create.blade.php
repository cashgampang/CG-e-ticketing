@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Create Verification Certificate & Products Shipment</h4>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('combined.store') }}" method="POST">
                            @csrf

                            <!-- Verification Certificate Section -->
                            <div class="card mb-4">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="mb-0">Verification Certificate Details</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="cn">CN <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="cn" name="cn"
                                                    value="{{ old('cn') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="iec">IEC <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="iec" name="iec"
                                                    value="{{ old('iec') }}" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="firm_name">Firm Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="firm_name" name="firm_name"
                                                    value="{{ old('firm_name') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="scheme">Scheme <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="scheme" name="scheme"
                                                    value="{{ old('scheme') }}" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="process">Process <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="process" name="process"
                                                    value="{{ old('process') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="doi_of_document">Date of Document <span
                                                        class="text-danger">*</span></label>
                                                <input type="date" class="form-control" id="doi_of_document"
                                                    name="doi_of_document" value="{{ old('doi_of_document') }}" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="doc_type">Document Type <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="doc_type" name="doc_type"
                                                    value="{{ old('doc_type') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="issuing_office">Issuing Office <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="issuing_office"
                                                    name="issuing_office" value="{{ old('issuing_office') }}" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="current_status">Current Status</label>
                                        <input type="text" class="form-control" id="current_status" name="current_status"
                                            value="{{ old('current_status') }}">
                                    </div>

                                    <!-- ECD Details -->
                                    <h6 class="mt-4 mb-3 text-primary">ECD Details</h6>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="ecd_application_number">ECD Application Number <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="ecd_application_number"
                                                    name="ecd_application_number"
                                                    value="{{ old('ecd_application_number') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="ecd_scheme_name">ECD Scheme Name <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="ecd_scheme_name"
                                                    name="ecd_scheme_name" value="{{ old('ecd_scheme_name') }}" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="ecd_exporter_name">ECD Exporter Name <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="ecd_exporter_name"
                                                    name="ecd_exporter_name" value="{{ old('ecd_exporter_name') }}"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="ecd_exporter_country">ECD Exporter Country <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="ecd_exporter_country"
                                                    name="ecd_exporter_country" value="{{ old('ecd_exporter_country') }}"
                                                    required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="ecd_exporter_address">ECD Exporter Address <span
                                                class="text-danger">*</span></label>
                                        <textarea class="form-control" id="ecd_exporter_address" name="ecd_exporter_address" rows="2" required>{{ old('ecd_exporter_address') }}</textarea>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="ecd_importer_name">ECD Importer Name <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="ecd_importer_name"
                                                    name="ecd_importer_name" value="{{ old('ecd_importer_name') }}"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="ecd_importer_country">ECD Importer Country <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="ecd_importer_country"
                                                    name="ecd_importer_country" value="{{ old('ecd_importer_country') }}"
                                                    required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="ecd_importer_address">ECD Importer Address <span
                                                class="text-danger">*</span></label>
                                        <textarea class="form-control" id="ecd_importer_address" name="ecd_importer_address" rows="2" required>{{ old('ecd_importer_address') }}</textarea>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="ecd_status">ECD Status <span
                                                        class="text-danger">*</span></label>
                                                <select class="form-control" id="ecd_status" name="ecd_status" required>
                                                    <option value="">Select Status</option>
                                                    <option value="Active"
                                                        {{ old('ecd_status') == 'Active' ? 'selected' : '' }}>Active
                                                    </option>
                                                    <option value="Pending"
                                                        {{ old('ecd_status') == 'Pending' ? 'selected' : '' }}>Pending
                                                    </option>
                                                    <option value="Approved"
                                                        {{ old('ecd_status') == 'Approved' ? 'selected' : '' }}>Approved
                                                    </option>
                                                    <option value="Rejected"
                                                        {{ old('ecd_status') == 'Rejected' ? 'selected' : '' }}>Rejected
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="ecd_means_of_transport_and_route">ECD Means of Transport and
                                                    Route</label>
                                                <input type="text" class="form-control"
                                                    id="ecd_means_of_transport_and_route"
                                                    name="ecd_means_of_transport_and_route"
                                                    value="{{ old('ecd_means_of_transport_and_route') }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="ecd_invoice_details">ECD Invoice Details <span
                                                class="text-danger">*</span></label>
                                        <textarea class="form-control" id="ecd_invoice_details" name="ecd_invoice_details" rows="2" required>{{ old('ecd_invoice_details') }}</textarea>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="ecd_application_file_by">ECD Application Filed By <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="ecd_application_file_by"
                                                    name="ecd_application_file_by"
                                                    value="{{ old('ecd_application_file_by') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="ecd_place_of_authorised_signatory">ECD Place of Authorised
                                                    Signatory <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control"
                                                    id="ecd_place_of_authorised_signatory"
                                                    name="ecd_place_of_authorised_signatory"
                                                    value="{{ old('ecd_place_of_authorised_signatory') }}" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="ecd_certified_issued_by">ECD Certified Issued By <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="ecd_certified_issued_by"
                                                    name="ecd_certified_issued_by"
                                                    value="{{ old('ecd_certified_issued_by') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="ecd_place_of_certifying_authority">ECD Place of Certifying
                                                    Authority <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control"
                                                    id="ecd_place_of_certifying_authority"
                                                    name="ecd_place_of_certifying_authority"
                                                    value="{{ old('ecd_place_of_certifying_authority') }}" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="ecd_certified_issuing_agency">ECD Certified Issuing Agency
                                                    <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control"
                                                    id="ecd_certified_issuing_agency" name="ecd_certified_issuing_agency"
                                                    value="{{ old('ecd_certified_issuing_agency') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="ecd_certified_issued_on">ECD Certified Issued On <span
                                                        class="text-danger">*</span></label>
                                                <input type="date" class="form-control" id="ecd_certified_issued_on"
                                                    name="ecd_certified_issued_on"
                                                    value="{{ old('ecd_certified_issued_on') }}" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="ecd_certified_country_of_origin">ECD Certified Country of Origin <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="ecd_certified_country_of_origin"
                                            name="ecd_certified_country_of_origin"
                                            value="{{ old('ecd_certified_country_of_origin') }}" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Products Shipment Section -->
                            <div class="card mb-4">
                                <div class="card-header bg-success text-white">
                                    <h5 class="mb-0">Products Shipment Details</h5>
                                </div>
                                <div class="card-body">
                                    <div id="products-container">
                                        <div class="product-item border p-3 mb-3">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <h6 class="mb-0">Product #1</h6>
                                                <button type="button" class="btn btn-danger btn-sm remove-product"
                                                    style="display: none;">Remove</button>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label>Marks and Number of Packages <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control"
                                                            name="products[0][marks_and_number_of_packages]"
                                                            value="{{ old('products.0.marks_and_number_of_packages') }}"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label>Number and Kind of Packages <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control"
                                                            name="products[0][number_and_kind_of_packages]"
                                                            value="{{ old('products.0.number_and_kind_of_packages') }}"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label>Description of Goods <span
                                                                class="text-danger">*</span></label>
                                                        <textarea class="form-control" name="products[0][description_of_goods]" rows="2" required>{{ old('products.0.description_of_goods') }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label>Origin Criterion <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control"
                                                            name="products[0][origin_criterion]"
                                                            value="{{ old('products.0.origin_criterion') }}" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label>Gross Weight or Other Quantity <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control"
                                                    name="products[0][gross_weight_or_other_quantity]"
                                                    value="{{ old('products.0.gross_weight_or_other_quantity') }}"
                                                    required>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="button" class="btn btn-outline-success" id="add-product">
                                        <i class="fas fa-plus"></i> Add Another Product
                                    </button>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-save"></i> Save Certificate & Products
                                    </button>
                                    <a href="{{ route('verif_certificate.index') }}" class="btn btn-secondary btn-lg">
                                        <i class="fas fa-arrow-left"></i> Cancel
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let productIndex = 1;

            // Add product functionality
            document.getElementById('add-product').addEventListener('click', function() {
                const container = document.getElementById('products-container');
                const newProduct = createProductHTML(productIndex);
                container.insertAdjacentHTML('beforeend', newProduct);
                updateRemoveButtons();
                productIndex++;
            });

            // Remove product functionality
            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-product')) {
                    e.target.closest('.product-item').remove();
                    updateRemoveButtons();
                    reindexProducts();
                }
            });

            function createProductHTML(index) {
                return `
            <div class="product-item border p-3 mb-3">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="mb-0">Product #${index + 1}</h6>
                    <button type="button" class="btn btn-danger btn-sm remove-product">Remove</button>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label>Marks and Number of Packages <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="products[${index}][marks_and_number_of_packages]" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label>Number and Kind of Packages <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="products[${index}][number_and_kind_of_packages]" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label>Description of Goods <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="products[${index}][description_of_goods]" rows="2" required></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label>Origin Criterion <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="products[${index}][origin_criterion]" required>
                        </div>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label>Gross Weight or Other Quantity <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="products[${index}][gross_weight_or_other_quantity]" required>
                </div>
            </div>
        `;
            }

            function updateRemoveButtons() {
                const products = document.querySelectorAll('.product-item');
                products.forEach((product, index) => {
                    const removeBtn = product.querySelector('.remove-product');
                    if (products.length > 1) {
                        removeBtn.style.display = 'inline-block';
                    } else {
                        removeBtn.style.display = 'none';
                    }
                });
            }

            function reindexProducts() {
                const products = document.querySelectorAll('.product-item');
                products.forEach((product, index) => {
                    // Update title
                    product.querySelector('h6').textContent = `Product #${index + 1}`;

                    // Update input names
                    const inputs = product.querySelectorAll('input, textarea');
                    inputs.forEach(input => {
                        const name = input.name;
                        if (name && name.includes('products[')) {
                            const fieldName = name.split('][')[1];
                            input.name = `products[${index}][${fieldName}`;
                        }
                    });
                });
                productIndex = products.length;
            }
        });
    </script>
@endsection
