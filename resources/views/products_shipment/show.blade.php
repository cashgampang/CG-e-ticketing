@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Shipment Details</h1>

    <ul class="list-group">
        <li class="list-group-item"><strong>Certificate ID:</strong> {{ $shipment->verif_certificate_id }}</li>
        <li class="list-group-item"><strong>Marks:</strong> {{ $shipment->marks_and_number_of_packages }}</li>
        <li class="list-group-item"><strong>Packages:</strong> {{ $shipment->number_and_kind_of_packages }}</li>
        <li class="list-group-item"><strong>Description:</strong> {{ $shipment->description_of_goods }}</li>
        <li class="list-group-item"><strong>Origin:</strong> {{ $shipment->origin_criterion }}</li>
        <li class="list-group-item"><strong>Gross Weight:</strong> {{ $shipment->gross_weight_or_other_quantity }}</li>
    </ul>

    <a href="{{ route('products-shipment.index') }}" class="btn btn-secondary mt-3">Back</a>
</div>
@endsection
