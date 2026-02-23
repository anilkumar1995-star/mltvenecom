<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\EcProduct;
use App\Models\EcProductCategory;
use App\Models\EcBrand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class VendorProductController extends Controller
{
    public function index()
    {
        $products = EcProduct::where('created_by_id', auth()->id())
            ->where('created_by_type', 'App\Models\Customer') // Assuming vendors are Customers with role 'vendor'
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('frontend.vendor.products.index', compact('products'));
    }

    public function create()
    {
        $categories = EcProductCategory::orderBy('id', 'desc')->get();
        $brands = EcBrand::orderBy('id', 'desc')->get();
        return view('frontend.vendor.products.create', compact('categories', 'brands'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:191',
            'price' => 'nullable|numeric|min:0',
            'quantity' => 'nullable|integer|min:0',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        DB::beginTransaction();

        try {
            $data = $request->only(['name', 'price', 'quantity', 'description', 'content', 'brand_id']);
            $data['slug'] = Str::slug($request->name) . '-' . time(); // Ensure uniqueness
            $data['sku'] = Str::upper(Str::random(3)) . '-' . time(); // Simple SKU generation
            $data['status'] = 'pending'; // FORCE PENDING STATUS
            $data['created_by_id'] = auth()->id();
            $data['created_by_type'] = 'App\Models\Customer';
            
            // Set required defaults for EcProduct model
            $data['is_variation'] = 0;
            $data['with_storehouse_management'] = 0;
            
            // Handle Featured Image
            if ($request->hasFile('image_file')) {
                $data['image'] = $request->file('image_file')->store('products', 'public');
                $data['images'] = [$data['image']]; // Set images array to include the main image
            }

            $product = EcProduct::create($data);

            // Commit transaction
            DB::commit();

            return redirect()->route('vendor.products.index')->with('success', 'Product created successfully and is pending approval.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Error creating product: ' . $e->getMessage());
        }
    }
}
