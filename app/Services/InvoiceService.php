<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use Illuminate\Support\Facades\DB;

class InvoiceService
{
    /**
     * Create an invoice from an order
     * 
     * @param Order $order
     * @return Invoice|null
     */
    public static function createInvoiceFromOrder(Order $order)
    {
        // Check if invoice already exists for this order
        $existingInvoice = Invoice::where('reference_id', $order->id)
            ->where('reference_type', get_class($order))
            ->first();
            
        if ($existingInvoice) {
            // Update status if order is completed
            if ($order->status === 'completed' && $existingInvoice->status !== 'paid') {
                $existingInvoice->update([
                    'status' => 'paid',
                    'paid_at' => now(),
                ]);
            }
            return $existingInvoice;
        }

        try {
            DB::beginTransaction();

            $customer = $order->user;
            $shippingAddress = DB::table('ec_order_addresses')->where('order_id', $order->id)->where('type', 'shipping')->first();

            $invoice = Invoice::create([
                'reference_id' => $order->id,
                'reference_type' => get_class($order),
                'customer_name' => $shippingAddress ? $shippingAddress->name : ($customer ? $customer->name : 'Guest'),
                'customer_email' => $shippingAddress ? $shippingAddress->email : ($customer ? $customer->email : 'guest@example.com'),
                'customer_phone' => $shippingAddress ? $shippingAddress->phone : ($customer ? $customer->phone : ''),
                'customer_address' => $shippingAddress ? $shippingAddress->address : '',
                'sub_total' => $order->sub_total,
                'tax_amount' => $order->tax_amount,
                'shipping_amount' => $order->shipping_amount,
                'discount_amount' => $order->discount_amount,
                'amount' => $order->amount,
                'payment_id' => $order->payment_id,
                'status' => $order->status === 'completed' ? 'paid' : 'pending',
                'paid_at' => $order->status === 'completed' ? now() : null,
                'coupon_code' => $order->coupon_code,
                'discount_description' => $order->discount_description,
                'description' => $order->description,
            ]);

            // Create invoice items
            $orderItems = DB::table('ec_order_product')->where('order_id', $order->id)->get();
            foreach ($orderItems as $item) {
                InvoiceItem::create([
                    'invoice_id' => $invoice->id,
                    'reference_id' => $item->product_id,
                    'reference_type' => 'App\\Models\\EcProduct',
                    'name' => $item->product_name,
                    'qty' => $item->qty,
                    'price' => $item->price,
                    'sub_total' => $item->price * $item->qty,
                    'tax_amount' => $item->tax_amount ?? 0,
                    'discount_amount' => 0,
                    'amount' => ($item->price * $item->qty) + ($item->tax_amount ?? 0),
                ]);
            }

            DB::commit();
            return $invoice;
        } catch (\Exception $e) {
            DB::rollBack();
            \Illuminate\Support\Facades\Log::error('Invoice Creation Failed: ' . $e->getMessage());
            return null;
        }
    }
}
