<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('verif_certificates', function (Blueprint $table) {
            $table->id();
            $table->string('UDIN');
            $table->string('cn');
            $table->string('iec');
            $table->string('firm_name');
            $table->string('scheme');
            $table->string('process');
            $table->date('doi_of_document');
            $table->string('doc_type');
            $table->string('issuing_office');
            $table->string('current_status')->nullable();

            $table->string('ecd_application_number');
            $table->string('ecd_scheme_name');
            $table->string('ecd_exporter_name');
            $table->text('ecd_exporter_address');
            $table->string('ecd_exporter_country');
            $table->string('ecd_importer_name');
            $table->text('ecd_importer_address');
            $table->string('ecd_importer_country');
            $table->string('ecd_status');
            $table->text('ecd_means_of_transport_and_route')->nullable();
            $table->text('ecd_invoice_details');
            $table->string('ecd_application_file_by');
            $table->string('ecd_place_of_authorised_signatory');
            $table->string('ecd_certified_issued_by');
            $table->string('ecd_place_of_certifying_authority');
            $table->string('ecd_certified_issuing_agency');
            $table->date('ecd_certified_issued_on');
            $table->string('ecd_certified_country_of_origin');
            $table->timestamps();        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verif_certificates');
    }
};
