<?php

namespace App\Models;

class Product extends EcProduct
{
    /**
     * This model is a proxy for EcProduct to maintain backward compatibility
     * with various controllers and relationships that expect App\Models\Product.
     */
}
