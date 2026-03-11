<?php

namespace App\Exports;

use App\Models\OrderReturn;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class OrderReturnsExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return OrderReturn::with(['order', 'user'])->latest()->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Order ID',
            'Customer Name',
            'Customer Email',
            'Reason',
            'Status',
            'Created At',
        ];
    }

    public function map($return): array
    {
        return [
            $return->id,
            $return->order ? $return->order->id : 'N/A',
            $return->user ? $return->user->name : 'Guest',
            $return->user ? $return->user->email : 'N/A',
            $return->reason,
            ucfirst($return->return_status),
            $return->created_at ? $return->created_at->format('Y-m-d H:i:s') : '',
        ];
    }
}
