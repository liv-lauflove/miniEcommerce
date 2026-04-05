<?php

namespace App\Services;

use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf as PdfFacade;
use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Facades\Mail;

class InvoiceService
{
    public function generatePdf(Order $order): PDF
    {
        $order->load(['user', 'items.product']);

        return PdfFacade::loadView('web.orders.invoice-pdf', [
            'order' => $order,
            'company' => [
                'name'    => config('company.name'),
                'address' => config('company.address'),
                'phone'   => config('company.phone'),
                'email'   => config('company.email'),
            ],
        ]);
    }

    public function downloadPdf(Order $order): \Illuminate\Http\Response
    {
        $pdf = $this->generatePdf($order);

        return $pdf->download("invoice-{$order->invoice_number}.pdf");
    }

    public function streamPdf(Order $order): \Symfony\Component\HttpFoundation\StreamedResponse
    {
        $pdf = $this->generatePdf($order);

        return $pdf->stream("invoice-{$order->invoice_number}.pdf");
    }

    public function sendInvoiceEmail(Order $order): void
    {
        $order->load(['user', 'items.product']);

        Mail::send('web.orders.invoice-email', [
            'order' => $order,
            'user' => $order->user,
        ], function ($message) use ($order) {
            $message->to($order->user->email, $order->user->name)
                ->subject("Invoice {$order->invoice_number} - " . config('app.name'))
                ->from(config('mail.from.address'), config('mail.from.name'));
        });
    }
}
