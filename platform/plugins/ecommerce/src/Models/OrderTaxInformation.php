<?php

namespace Botble\Ecommerce\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderTaxInformation extends BaseModel
{
    protected $table = 'ec_order_tax_information';

    protected $fillable = [
        'order_id',
        'company_name',
        'company_address',
        'company_tax_code',
        'company_email',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
