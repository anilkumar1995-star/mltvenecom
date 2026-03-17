<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\EcProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlist = Session::get('wishlist', []);
        $productIds = array_keys($wishlist);
        $products = EcProduct::whereIn('id', $productIds)->get();
        return view('frontend.wishlist.index', compact('products', 'wishlist'));
    }

    public function toggle(Request $request)
    {
        $productId = $request->product_id;
        $product = EcProduct::findOrFail($productId);

        $wishlist = Session::get('wishlist', []);

        if (isset($wishlist[$productId])) {
            unset($wishlist[$productId]);
            $inWishlist = false;
            $message = 'Removed from wishlist!';
        } else {
            $wishlist[$productId] = [
                'id'    => $product->id,
                'name'  => $product->name,
                'price' => $product->final_price,
                'image' => $product->image,
                'slug'  => $product->slug ?: $product->id,
            ];
            $inWishlist = true;
            $message = 'Added to wishlist!';
        }

        Session::put('wishlist', $wishlist);

        if ($request->ajax()) {
            return response()->json([
                'success'     => true,
                'message'     => $message,
                'in_wishlist' => $inWishlist,
                'count'       => count($wishlist),
            ]);
        }

        return back()->with('success', $message);
    }

    // Legacy methods kept for compatibility
    public function store($productId)
    {
        return $this->toggle(request()->merge(['product_id' => $productId]));
    }

    public function destroy($productId)
    {
        $wishlist = Session::get('wishlist', []);
        unset($wishlist[$productId]);
        Session::put('wishlist', $wishlist);
        return response()->json(['status' => true, 'message' => 'Removed from wishlist.', 'count' => count($wishlist)]);
    }
}
