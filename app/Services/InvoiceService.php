<?php

namespace App\Services;

use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;

class InvoiceService
{
    public function generatePdf(Order $order): \Barryvdh\DomPDF\Facade\Pdf
    {
        $order->load(['user', 'items.product']);

        return Pdf::loadView('web.orders.invoice-pdf', [
            'order' => $order,
            'company' => [
                'name' => config('app.name'),
                'address' => 'Jl. Sudirman No. 123, Jakarta',
                'phone' => '+62 21 1234 5678',
                'email' => 'hello@miniecommerce.com',
            ],
        ]);
    }

    public function downloadPdf(Order $order): \Symfony\Component\HttpFoundation\StreamedResponse
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
