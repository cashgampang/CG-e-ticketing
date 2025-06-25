<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductsShipment extends Model
{
    protected $fillable = [
        'verif_certificate_id',
        'marks_and_number_of_packages',
        'number_and_kind_of_packages',
        'description_of_goods',
        'origin_criterion',
        'gross_weight_or_other_quantity'
    ];

    public function products_shipments(){
        return $this->belongsTo(VerifCertificate::class);
    }
}
