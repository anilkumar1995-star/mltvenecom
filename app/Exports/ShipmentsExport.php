<?php

namespace App\Exports;

use App\Models\Shipment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ShipmentsExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Shipment::with(['order.user'])->latest()->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Order ID',
            'Customer Name',
            'Customer Email',
            'Price ($)',
            'COD Status',
            'Shipment Status',
            'Created At',
        ];
    }

    public function map($shipment): array
    {
        return [
            $shipment->id,
            $shipment->order_id ?? 'N/A',
            ($shipment->order && $shipment->order->user) ? $shipment->order->user->name : 'Guest',
            ($shipment->order && $shipment->order->user) ? $shipment->order->user->email : 'N/A',
            number_format($shipment->price, 2),
            ucfirst($shipment->cod_status),
            ucfirst($shipment->status),
            $shipment->created_at ? $shipment->created_at->format('Y-m-d H:i:s') : '',
        ];
    }
}
