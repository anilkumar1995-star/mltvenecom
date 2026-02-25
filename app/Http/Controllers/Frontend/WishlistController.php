<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class WishlistController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Wishlist Page
    |--------------------------------------------------------------------------
    */
    public function index(Request $request)
    {
        if (Auth::check()) {
            // Logged in user wishlist (DB relation)
            $products = Auth::user()
                ->wishlist()
                ->with('images')
                ->paginate(12);
        } else {
            // Guest wishlist (session)
            $wishlist = Session::get('wishlist', []);
            $products = Product::whereIn('id', $wishlist)
                ->with('images')
                ->paginate(12);
        }

        return view('frontend.wishlist', compact('products'));
    }

    /*
    |--------------------------------------------------------------------------
    | Add / Remove Wishlist (Toggle)
    |--------------------------------------------------------------------------
    */
    public function store($productId)
    {
        $product = Product::findOrFail($productId);

        if (Auth::check()) {

            $user = Auth::user();

            if ($user->wishlist()->where('product_id', $productId)->exists()) {
                $user->wishlist()->detach($productId);
                $added = false;
            } else {
                $user->wishlist()->attach($productId);
                $added = true;
            }

            $count = $user->wishlist()->count();

        } else {
            $wishlist = Session::get('wishlist', []);

            if (in_array($productId, $wishlist)) {
                $wishlist = array_diff($wishlist, [$productId]);
                $added = false;
            } else {
                $wishlist[] = $productId;
                $added = true;
            }

            Session::put('wishlist', $wishlist);
            $count = count($wishlist);
        }

        return response()->json([
            'status' => true,
            'message' => $added
                ? $product->name . ' added to wishlist.'
                : $product->name . ' removed from wishlist.',
            'count' => $count,
            'added' => $added
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Remove Wishlist
    |--------------------------------------------------------------------------
    */
    public function destroy($productId)
    {
        $product = Product::findOrFail($productId);

        if (Auth::check()) {
            Auth::user()->wishlist()->detach($productId);
            $count = Auth::user()->wishlist()->count();
        } else {
            $wishlist = Session::get('wishlist', []);
            $wishlist = array_diff($wishlist, [$productId]);
            Session::put('wishlist', $wishlist);
            $count = count($wishlist);
        }

        return response()->json([
            'status' => true,
            'message' => $product->name . ' removed from wishlist.',
            'count' => $count
        ]);
    }
}
