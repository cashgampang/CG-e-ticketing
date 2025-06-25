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
        Schema::create('products_shipments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('verif_certificate_id')->constrained('verif_certificates')->onDelete('cascade');
            $table->text('marks_and_number_of_packages');
            $table->text('number_and_kind_of_packages');
            $table->text('description_of_goods');
            $table->string('origin_criterion');
            $table->string('gross_weight_or_other_quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products_shipments');
    }
};
