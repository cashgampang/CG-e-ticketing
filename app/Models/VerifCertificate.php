<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VerifCertificate extends Model
{
    protected $fillable = [
        'UDIN',
        'cn',
        'iec',
        'firm_name',
        'scheme',
        'process',
        'doi_of_document',
        'doc_type',
        'issuing_office',
        'current_status',
        'ecd_application_number',
        'ecd_scheme_name',
        'ecd_exporter_name',
        'ecd_exporter_address',
        'ecd_exporter_country',
        'ecd_importer_name',
        'ecd_importer_address',
        'ecd_importer_country',
        'ecd_status',
        'ecd_means_of_transport_and_route',
        'ecd_invoice_details',
        'ecd_application_file_by',
        'ecd_place_of_authorised_signatory',
        'ecd_certified_issued_by',
        'ecd_place_of_certifying_authority',
        'ecd_certified_issuing_agency',
        'ecd_certified_issued_on',
        'ecd_certified_country_of_origin'
    ];

    public function products_shipments(){
        return $this->hasMany(ProductsShipment::class);
    }
}
