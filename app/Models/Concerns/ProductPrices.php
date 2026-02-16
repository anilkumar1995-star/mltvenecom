<?php

namespace App\Models\Concerns;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait ProductPrices
{
    protected float $originalPrice = 0;
    protected float $finalPrice = 0;

    // Accessor for price (final price or original)
    public function price(): float
    {
        return $this->finalPrice ?: $this->originalPrice ?: 0;
    }

    // Flash sale price (if you manage it yourself)
    public function getFlashSalePrice(): ?float
    {
        if (! isset($this->flash_sale_price)) {
            return $this->price();
        }

        if (isset($this->flash_sale_quantity, $this->flash_sale_sold) &&
            $this->flash_sale_quantity > $this->flash_sale_sold) {
            return $this->flash_sale_price;
        }

        return $this->price();
    }

    // Discounted price
    public function getDiscountPrice(): float
    {
        $price = $this->price();

        if (! isset($this->discount_type, $this->discount_value)) {
            return $price;
        }

        return match ($this->discount_type) {
            'same_price' => $this->discount_value,
            'amount' => max(0, $price - $this->discount_value),
            'percentage' => max(0, $price - ($price * $this->discount_value / 100)),
            default => $price,
        };
    }

    // Price including taxes
    public function priceWithTaxes(): float
    {
        if (! isset($this->tax_percentage) || $this->price_includes_tax) {
            return $this->price();
        }

        return $this->price() * (1 + $this->tax_percentage / 100);
    }

    // Sale percentage
    public function salePercent(): int
    {
        $original = $this->price();
        $sale = $this->getDiscountPrice();

        if ($original <= 0 || $sale >= $original) {
            return 0;
        }

        return (int) round(($original - $sale) / $original * 100);
    }

    // Check if on sale
    public function isOnSale(): bool
    {
        return $this->getDiscountPrice() < $this->price();
    }

    // Get/set original price
    public function getOriginalPrice(): float
    {
        return $this->originalPrice;
    }

    public function setOriginalPrice(float $price): static
    {
        $this->originalPrice = $price;
        return $this;
    }

    // Get/set final price
    public function getFinalPrice(): float
    {
        return $this->finalPrice ?: $this->price();
    }

    public function setFinalPrice(float $price): static
    {
        $this->finalPrice = $price;
        return $this;
    }

    // Accessor for displaying formatted price
    protected function priceInTable(): Attribute
    {
        return Attribute::get(function () {
            $price = number_format($this->getDiscountPrice(), 2);
            if ($this->getDiscountPrice() < $this->price()) {
                $price .= ' <del>' . number_format($this->price(), 2) . '</del>';
            }
            return $price;
        });
    }
}
