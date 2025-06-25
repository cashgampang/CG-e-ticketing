<?php

namespace App\Http\Controllers;

use App\Models\ProductsShipment;
use App\Models\VerifCertificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class ProductsShipmentController extends Controller
{
    // Menampilkan semua data
    public function index(Request $request)
    {
        $certId = $request->query('verif_certificate_id');

        $shipments = ProductsShipment::when($certId, function ($query, $certId) {
            return $query->where('verif_certificate_id', $certId);
        })->get();

        return view('products_shipment.index', compact('shipments', 'certId'));
    }

    public function create()
    {
        $shipments = ProductsShipment::all();
        $certificates = VerifCertificate::all();
        return view('products_shipment.create', compact('shipments', 'certificates'));
    }

    // Menyimpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'verif_certificate_id' => 'required|exists:verif_certificates,id',
            'products' => 'required|array|min:1',
            'products.*.marks_and_number_of_packages' => 'required|string',
            'products.*.number_and_kind_of_packages' => 'required|string',
            'products.*.description_of_goods' => 'required|string',
            'products.*.origin_criterion' => 'required|string',
            'products.*.gross_weight_or_other_quantity' => 'required|string',
        ]);

        foreach ($request->products as $product) {
            ProductsShipment::create([
                'verif_certificate_id' => $request->verif_certificate_id,
                'marks_and_number_of_packages' => $product['marks_and_number_of_packages'],
                'number_and_kind_of_packages' => $product['number_and_kind_of_packages'],
                'description_of_goods' => $product['description_of_goods'],
                'origin_criterion' => $product['origin_criterion'],
                'gross_weight_or_other_quantity' => $product['gross_weight_or_other_quantity'],
            ]);
        }

        // Hapus cookie setelah berhasil
        Cookie::queue(Cookie::forget('verif_certificate_id'));

        return redirect()->route('products-shipment.index', ['verif_certificate_id' => $request->verif_certificate_id])->with('success', 'Semua produk berhasil disimpan.');
    }


    // Menampilkan detail shipment tertentu
    public function show($id)
    {
        $certificate = VerifCertificate::with('products_shipments')->findOrFail($id);
        return view('verif_certificate.show', compact('certificate'));
    }

    public function edit($id)
    {
        $shipment = ProductsShipment::findOrFail($id);
        return view('products_shipment.edit', compact('shipment'));
    }

    // Update data
    public function update(Request $request, $id)
    {
        $shipment = ProductsShipment::findOrFail($id);
        $shipment->update($request->all());
        return redirect()->route('products-shipment.index', ['verif_certificate_id' => $shipment->verif_certificate_id])->with('success', 'Produk Keupdate');
    }

    // Hapus data
    public function destroy($id)
    {
        $shipment = ProductsShipment::findOrFail($id);
        $shipment->delete();
        return redirect()->route('products-shipment.index', ['verif_certificate_id' => $shipment->verif_certificate_id])->with('success', 'Produk keapus');
    }
}
