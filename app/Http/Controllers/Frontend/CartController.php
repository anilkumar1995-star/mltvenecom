<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\EcProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        Session::forget('applied_coupon');
        $cart = Session::get('cart', []);
        $total = 0;
        $updated = false;

        foreach ($cart as $id => $item) {
            $total += $item['price'] * $item['quantity'];
            
            // Ensure weight and unit_type are present for older session items
            if (!isset($item['weight']) || !isset($item['unit_type'])) {
                $product = EcProduct::find($id);
                if ($product) {
                    $cart[$id]['weight'] = $product->weight;
                    $cart[$id]['unit_type'] = $product->unit_type;
                    $updated = true;
                }
            }
        }

        if ($updated) {
            Session::put('cart', $cart);
        }

        return view('frontend.cart.index', compact('cart', 'total'));
    }

    public function add(Request $request)
    {
        $product_ids = $request->input('product_ids');
        if (!is_array($product_ids)) {
            $product_ids = [$request->input('product_id')];
        }

        $cart = Session::get('cart', []);
        $quantity = $request->quantity ?? 1;
        $added_count = 0;

        foreach ($product_ids as $id) {
            if (!$id) continue;
            
            $product = EcProduct::where('id', $id)->first();
            if (!$product) continue;

            $currentCartQty = isset($cart[$product->id]) ? $cart[$product->id]['quantity'] : 0;
            $requestedQty = $currentCartQty + $quantity;

            if ($product->with_storehouse_management == 1 && $product->allow_checkout_when_out_of_stock == 0) {
                if ($product->quantity <= 0 || $product->stock_status === 'out_of_stock') {
                    if ($request->ajax()) {
                        return response()->json(['success' => false, 'error' => true, 'message' => "{$product->name} is out of stock!"]);
                    }
                    return back()->with('error', "{$product->name} is out of stock!");
                }
                if ($requestedQty > $product->quantity) {
                    if ($request->ajax()) {
                        return response()->json(['success' => false, 'error' => true, 'message' => "Only {$product->quantity} items available for {$product->name}."]);
                    }
                    return back()->with('error', "Only {$product->quantity} items available for {$product->name}.");
                }
            }

            // Min/Max Order Quantity Check
            if ($product->minimum_order_quantity > 0 && $requestedQty < $product->minimum_order_quantity) {
                $msg = "Minimum order quantity for {$product->name} is {$product->minimum_order_quantity}.";
                if ($request->ajax()) return response()->json(['success' => false, 'error' => true, 'message' => $msg]);
                return back()->with('error', $msg);
            }
            if ($product->maximum_order_quantity > 0 && $requestedQty > $product->maximum_order_quantity) {
                $msg = "Maximum order quantity for {$product->name} is {$product->maximum_order_quantity}.";
                if ($request->ajax()) return response()->json(['success' => false, 'error' => true, 'message' => $msg]);
                return back()->with('error', $msg);
            }

            if (isset($cart[$product->id])) {
                $cart[$product->id]['quantity'] += $quantity;
            } else {
                $cart[$product->id] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->final_price,
                    'quantity' => $quantity,
                    'image' => $product->image,
                    'slug' => $product->slug ?: $product->id,
                    'min_qty' => $product->minimum_order_quantity,
                    'max_qty' => $product->maximum_order_quantity,
                    'stock_qty' => $product->quantity,
                    'with_storehouse' => $product->with_storehouse_management,
                    'allow_checkout' => $product->allow_checkout_when_out_of_stock,
                ];
            }
            $added_count++;
        }

        if ($added_count > 0) {
            Session::put('cart', $cart);
        }

        if ($request->ajax()) {
            $total = 0;
            foreach ($cart as $item) {
                $total += $item['price'] * $item['quantity'];
            }
            $is_already_added = false;
            foreach ($product_ids as $pid) {
                if (isset(Session::get('cart', [])[$pid])) {
                    $is_already_added = true;
                    break;
                }
            }

            return response()->json([
                'success' => true,
                'error' => false,
                'is_already_added' => $is_already_added,
                'message' => $added_count > 1 ? 'Bundle added to cart!' : 'Product added to cart!',
                'count' => count($cart),
                'subtotal' => $total,
                'html' => view('frontend.partials.mini-cart')->render(),
                'data' => [
                    'count' => count($cart),
                    'subtotal' => $total,
                    'cart_mini' => view('frontend.partials.mini-cart')->render(),
                    'product_id' => $product_ids[0] ?? null,
                    'quantity' => isset($cart[$product_ids[0]]) ? $cart[$product_ids[0]]['quantity'] : 0,
                ],
            ]);
        }

        return back()->with('success', $added_count > 1 ? 'Bundle added to cart!' : 'Product added to cart!');
    }

    public function update(Request $request)
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$request->product_id])) {
            $newQty = (int) $request->quantity;
            $product = EcProduct::find($request->product_id);

            if ($newQty > 0 && $product) {
                if ($product->with_storehouse_management == 1 && $product->allow_checkout_when_out_of_stock == 0) {
                    if ($product->quantity <= 0 || $product->stock_status === 'out_of_stock') {
                        if ($request->ajax()) {
                            return response()->json(['success' => false, 'error' => true, 'message' => "This product is out of stock!"]);
                        }
                        return back()->with('error', "This product is out of stock!");
                    }
                    if ($newQty > $product->quantity) {
                        if ($request->ajax()) {
                            return response()->json(['success' => false, 'error' => true, 'message' => "Only {$product->quantity} items available."]);
                        }
                        return back()->with('error', "Only {$product->quantity} items available.");
                    }
                }

                // Min/Max Order Quantity Check
                if ($product->minimum_order_quantity > 0 && $newQty < $product->minimum_order_quantity) {
                    $msg = "Minimum order quantity is {$product->minimum_order_quantity}.";
                    if ($request->ajax()) return response()->json(['success' => false, 'error' => true, 'message' => $msg]);
                    return back()->with('error', $msg);
                }
                if ($product->maximum_order_quantity > 0 && $newQty > $product->maximum_order_quantity) {
                    $msg = "Maximum order quantity is {$product->maximum_order_quantity}.";
                    if ($request->ajax()) return response()->json(['success' => false, 'error' => true, 'message' => $msg]);
                    return back()->with('error', $msg);
                }
            }

            if ($newQty <= 0) {
                unset($cart[$request->product_id]);
            } else {
                $cart[$request->product_id]['quantity'] = $newQty;
            }
            Session::put('cart', $cart);
        }

        if ($request->ajax()) {
            $total = 0;
            foreach ($cart as $item) {
                $total += $item['price'] * $item['quantity'];
            }
            return response()->json([
                'success' => true,
                'message' => 'Cart updated!',
                'count' => count($cart),
                'subtotal' => $total,
                'product_id' => $request->product_id,
                'quantity' => isset($cart[$request->product_id]) ? $cart[$request->product_id]['quantity'] : 0,
                'html' => view('frontend.partials.mini-cart')->render(),
            ]);
        }

        return back()->with('success', 'Cart updated!');
    }

    public function remove(Request $request, $id)
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            Session::put('cart', $cart);
        }

        if ($request->ajax()) {
            $total = 0;
            foreach ($cart as $item) {
                $total += $item['price'] * $item['quantity'];
            }
            return response()->json([
                'success' => true,
                'message' => 'Product removed from cart!',
                'count' => count($cart),
                'subtotal' => $total,
                'html' => view('frontend.partials.mini-cart')->render(),
            ]);
        }

        return back()->with('success', 'Product removed from cart!');
    }

    public function buyNow(Request $request)
    {
        $product = EcProduct::findOrFail($request->product_id);

        $cart = Session::get('cart', []);
        $quantity = $request->quantity ?? 1;

        if ($product->with_storehouse_management == 1 && $product->allow_checkout_when_out_of_stock == 0) {
            $currentCartQty = isset($cart[$product->id]) ? $cart[$product->id]['quantity'] : 0;
            $requestedQty = $currentCartQty + $quantity;

            if ($product->quantity <= 0 || $product->stock_status === 'out_of_stock') {
                return back()->with('error', "{$product->name} is out of stock!");
            }
            if ($requestedQty > $product->quantity) {
                return back()->with('error', "Only {$product->quantity} items available for {$product->name}.");
            }
        }

        $calcQty = (isset($cart[$product->id]) ? $cart[$product->id]['quantity'] : 0) + $quantity;
        if ($product->minimum_order_quantity > 0 && $calcQty < $product->minimum_order_quantity) {
            return back()->with('error', "Minimum order quantity is {$product->minimum_order_quantity}.");
        }
        if ($product->maximum_order_quantity > 0 && $calcQty > $product->maximum_order_quantity) {
            return back()->with('error', "Maximum order quantity is {$product->maximum_order_quantity}.");
        }

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $quantity;
        } else {
            $cart[$product->id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->final_price,
                'quantity' => $quantity,
                'image' => $product->image,
                'slug' => $product->slug ?: $product->id,
                'min_qty' => $product->minimum_order_quantity,
                'max_qty' => $product->maximum_order_quantity,
                'stock_qty' => $product->quantity,
                'with_storehouse' => $product->with_storehouse_management,
                'allow_checkout' => $product->allow_checkout_when_out_of_stock,
            ];
        }

        Session::put('cart', $cart);

        return redirect()->route('frontend.checkout.index');
    }
}
