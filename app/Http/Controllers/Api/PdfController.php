<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    public function generate($id)
    {
        $order = Order::with('client', 'products')->findOrFail($id);

        $pdf = Pdf::loadView('pdf.order', compact('order'));

        return $pdf->stream("orden_{$order->id}.pdf");
    }
}
