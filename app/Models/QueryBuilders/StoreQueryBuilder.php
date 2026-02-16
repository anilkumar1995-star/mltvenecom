<?php

namespace App\Models\QueryBuilders;

use Illuminate\Database\Eloquent\Builder;

class StoreQueryBuilder extends Builder
{
    /**
     * Filter only published stores with verified vendors.
     *
     * @param string $column
     * @return $this
     */
    public function wherePublished(string $column = 'status'): static
    {
        // Only where published (assuming 'published' status is 1)
        $this->where($column, 1);

        // Only stores whose customer is a verified vendor
        $this->whereHas('customer', function ($query) {
            $query->where('is_vendor', true)
                  ->whereNotNull('vendor_verified_at');
        });

        return $this;
    }
}
