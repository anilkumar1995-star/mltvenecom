<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Arr;

class InvoiceItem extends Model
{
    protected $table = 'ec_invoice_items';

    protected $fillable = [
        'invoice_id',
        'reference_type',
        'reference_id',
        'name',
        'description',
        'image',
        'qty',
        'price',
        'sub_total',
        'tax_amount',
        'discount_amount',
        'amount',
        'metadata',
        'options',
    ];

    protected $casts = [
        'sub_total' => 'float',
        'tax_amount' => 'float',
        'discount_amount' => 'float',
        'amount' => 'float',
        'metadata' => 'json',
        'paid_at' => 'datetime',
        'options' => 'json',
        'name' => 'string',
    ];

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

    public function reference(): MorphTo
    {
        return $this->morphTo();
    }

    protected function amountFormat(): Attribute
    {
        return Attribute::get(fn () => number_format($this->price, 2));
    }

    protected function totalFormat(): Attribute
    {
        return Attribute::get(fn () => number_format($this->price * $this->qty, 2));
    }

    public function productOptionsImplode(): Attribute
    {
        return Attribute::get(function () {
            $options = $this->product_options_array;

            if (! $options) {
                return '';
            }

            return '(' . implode(', ', Arr::map($options, function ($item) use ($options): string {
                return implode(': ', [
                    $item['label'],
                    $item['value'] . ($item['affect_price'] ? ' (+' . $item['affect_price'] . ')' : ''),
                ]);
            })) . ')';
        });
    }

    public function productOptionsArray(): Attribute
    {
        return Attribute::get(function () {
            if (! $this->options) {
                return [];
            }

            $options = Arr::get($this->options, 'options');

            if (! $options) {
                return [];
            }

            return Arr::map(Arr::get($options, 'optionInfo'), function ($item, $key) use ($options) {
                $affectedPrice = Arr::get($options, "optionCartValue.$key.0.affect_price");

                return [
                    'label' => $item,
                    'value' => Arr::get($options, "optionCartValue.$key.0.option_value"),
                    'affect_price' => $affectedPrice ? number_format($affectedPrice, 2) : '',
                ];
            });
        });
    }
}

