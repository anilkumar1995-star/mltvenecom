<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\MassPrunable;

class SharedWishlist extends Model
{
    use MassPrunable;

    protected $table = 'ec_shared_wishlists';

    protected $fillable = [
        'code',
        'product_ids',
    ];

    protected $casts = [
        'product_ids' => 'array',
    ];

    public function prunable(): Builder
    {
        return $this->where('created_at', '<=', Carbon::now()->subDays(30)); // Default to 30 days
    }
}

