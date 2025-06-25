<?php

namespace App\Http\Controllers;

use App\Models\VerifCertificate;
use App\Models\ProductsShipment;
use Endroid\QrCode\Builder\Builder;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class VerifCertificateController extends Controller
{
    // Menampilkan semua data
    public function index()
    {
        $certificates = VerifCertificate::all();
        return view('verif_certificate.index', compact('certificates'));
    }

    public function create()
    {
        $certificates = VerifCertificate::all();
        return view('verif_certificate.create', compact('certificates'));
    }

    public function store(Request $request)
    {
        $UDIN = Str::random(40);

        $validated = $request->validate([
            'cn' => 'required|string',
            'iec' => 'required|string',
            'firm_name' => 'required|string',
            'scheme' => 'required|string',
            'process' => 'required|string',
            'doi_of_document' => 'required|date',
            'doc_type' => 'required|string',
            'issuing_office' => 'required|string',
            'current_status' => 'nullable|string',
            'ecd_application_number' => 'required|string',
            'ecd_scheme_name' => 'required|string',
            'ecd_exporter_name' => 'required|string',
            'ecd_exporter_address' => 'required|string',
            'ecd_exporter_country' => 'required|string',
            'ecd_importer_name' => 'required|string',
            'ecd_importer_address' => 'required|string',
            'ecd_importer_country' => 'required|string',
            'ecd_status' => 'required|string',
            'ecd_means_of_transport_and_route' => 'nullable|string',
            'ecd_invoice_details' => 'required|string',
            'ecd_application_file_by' => 'required|string',
            'ecd_place_of_authorised_signatory' => 'required|string',
            'ecd_certified_issued_by' => 'required|string',
            'ecd_place_of_certifying_authority' => 'required|string',
            'ecd_certified_issuing_agency' => 'required|string',
            'ecd_certified_issued_on' => 'required|date',
            'ecd_certified_country_of_origin' => 'required|string',
        ]);

        $validated['UDIN'] = $UDIN;

        $certificate = VerifCertificate::create($validated);

        $qrUrl = url('/downloadfileservlet/download?UDIN=' . $certificate->UDIN);
        $qrPath = public_path('qr/' . $certificate->UDIN . '.png');

        $qr = Builder::create()
            ->data($qrUrl)
            ->size(300)
            ->margin(10)
            ->build();

        if (!file_exists(dirname($qrPath))) {
            mkdir(dirname($qrPath), 0755, true);
        }

        file_put_contents($qrPath, $qr->getString());

        // Simpan ID ke cookie (kedaluwarsa dalam 30 menit)
        return redirect()
            ->route('products-shipment.create')
            ->with('success', 'Berhasil menambahkan Certificate Documents')
            ->cookie('verif_certificate_id', $certificate->id); // 30 = menit
    }

    // Menampilkan satu data berdasarkan ID
    public function show($id)
    {
        $certificate = VerifCertificate::findOrFail($id);
        // $shipment = ProductsShipment::with('products_shipments')->findOrFail($id);
        return view('verif_certificate.show', compact('certificate'));
    }
    public function showByUDIN(Request $request)
    {
        $udin = $request->query('UDIN');

        // Ambil certificate berdasarkan UDIN
        $certificate = VerifCertificate::where('UDIN', $udin)->firstOrFail();

        // Call ulang function show() berdasarkan ID
        return $this->show($certificate->id);
    }

    public function showQR($UDIN)
    {
        $certificate = VerifCertificate::where('UDIN', $UDIN)->firstOrFail();
        $url = url('/downloadfileservlet/download?UDIN=' . $certificate->UDIN);
        $qrImage = asset("qr/{$UDIN}.png");

        return view('show-qr', compact('certificate', 'url', 'qrImage'));
    }
    public function edit($id)
    {
        $certificate = VerifCertificate::findOrFail($id);
        return view('verif_certificate.edit', compact('certificate'));
    }

    // Memperbarui data
    public function update(Request $request, $id)
    {
        $certificate = VerifCertificate::findOrFail($id);
        $UDIN = $certificate->UDIN;
        $request['UDIN'] = $UDIN;
        $certificate->update($request->all());
        return redirect()->route('dashboard')->with('success', 'Pokoknya keupdate lah');
    }

    // Menghapus data
    public function destroy($id)
    {
        $certificate = VerifCertificate::findOrFail($id);
        $certificate->delete();

        // Hapus QR code terkait
        $qrPath = public_path('qr/' . $certificate->UDIN . '.png');
        if (file_exists($qrPath)) {
            unlink($qrPath);
        }

        return redirect()->route('dashboard')->with('success', 'Pokoknya ke hapus');
    }
}
