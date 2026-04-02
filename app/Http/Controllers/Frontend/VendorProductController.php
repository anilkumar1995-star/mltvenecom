<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\EcProduct;
use App\Models\EcProductCategory;
use App\Models\EcBrand;
use App\Models\EcSpecificationTable;
use App\Models\ProductAttribute;
use App\Models\ProductAttributeSet;
use App\Models\Option;
use App\Models\OptionValue;
use App\Models\GlobalOption;
use App\Models\GlobalOptionValue;
use App\Models\AppFaq;
use App\Models\ProductCollection;
use App\Models\ProductLabel;
use App\Models\Tax;
use App\Models\EcProductTag;
use App\Models\Store;
use App\Models\Order;
use App\Models\Review;
use App\Models\Customer;
use App\Models\EcProductFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Helpers\ImageHelper;

use App\Helpers\TableHelpers;

class VendorProductController extends Controller
{
    public function index(Request $request)
    {
        $userId = auth('customer')->id();
        $query = EcProduct::where('created_by_id', $userId)
            ->where('created_by_type', Customer::class);

        TableHelpers::applyTableLogic($query, $request,
        ['id', 'name', 'sku'], // searchable
        ['id', 'name', 'sku', 'price', 'status', 'created_at'] // filterable
        );

        $products = $query->orderBy('id', 'desc')->paginate(TableHelpers::getPerPage($request));

        $filterColumns = [
            'id' => 'ID',
            'name' => 'Name',
            'sku' => 'SKU',
            'price' => 'Price',
            'stock_status' => 'Stock Status',
            'quantity' => 'Quantity',
            'order' => 'Sort Order',
            'status' => 'Status',
            'created_at' => 'Created At'
        ];

        return view('frontend.vendor.products.index', compact('products', 'filterColumns'));
    }

    public function dashboard()
    {
        $user = auth('customer')->user();

        // Get the vendor's store early so we can show it even if not approved
        $store = Store::where('customer_id', $user->id)->first();

        // Check if vendor is NOT yet verified by admin
        if (!$user->vendor_verified_at) {
            return view('frontend.vendor.not-approved', compact('user', 'store'));
        }

        // Get the vendor's store
        $store = Store::where('customer_id', $user->id)->first();

        $productsCount = $store
            ?EcProduct::where('store_id', $store->id)->count()
            : EcProduct::where('created_by_id', $user->id)->where('created_by_type', Customer::class)->count();

        $ordersCount = $store
            ?Order::where('store_id', $store->id)->count()
            : 0;

        $revenueCount = $store
            ?Order::where('store_id', $store->id)->where('status', 'completed')->sum('amount')
            : 0;

        $pendingOrdersCount = $store
            ?Order::where('store_id', $store->id)->where('status', 'pending')->count()
            : 0;

        $reviewsCount = Review::where('customer_id', $user->id)->count();

        $recentProducts = EcProduct::where('created_by_id', $user->id)
            ->where('created_by_type', Customer::class)
            ->latest()
            ->take(5)
            ->get();

        return view('frontend.vendor.dashboard', compact(
            'ordersCount', 'productsCount', 'reviewsCount',
            'revenueCount', 'pendingOrdersCount', 'recentProducts', 'store'
        ));
    }

    public function create(Request $request)
    {
        $user = auth('customer')->user();

        // Check KYC status first
        if (!$user || ($user->kyc_status !== 'approved' && $user->kyc_status !== 'verified')) {
            return redirect()->route('frontend.vendor.dashboard')
                ->with('error', 'Your KYC is ' . ($user->kyc_status ?? 'pending') . '. Please complete your KYC to add products.');
        }

        // Check Administrative approval
        if (!$user->vendor_verified_at) {
            return redirect()->route('frontend.vendor.dashboard')
                ->with('error', 'Please wait for administrative approval before adding products.');
        }

        $type = $request->input('type', 'physical');

        $data['categories'] = EcProductCategory::orderBy('id', 'desc')->get();
        $data['brands'] = EcBrand::orderBy('id', 'desc')->get();
        $data['tables'] = EcSpecificationTable::orderBy('id', 'desc')->get();
        $data['attributes'] = ProductAttribute::orderBy('id', 'desc')->get();
        $data['attributeSets'] = ProductAttributeSet::orderBy('id', 'desc')->get();
        $data['options'] = Option::orderBy('id', 'desc')->get();
        $data['optionsValues'] = OptionValue::orderBy('id', 'desc')->get();
        $data['globalOptions'] = GlobalOption::orderBy('id', 'desc')->get();
        $data['globalOptionsValue'] = GlobalOptionValue::orderBy('id', 'desc')->get();
        $data['faqs'] = AppFaq::orderBy('id', 'desc')->get();
        $data['collections'] = ProductCollection::orderBy('id', 'desc')->get();
        $data['productionlabels'] = ProductLabel::orderBy('id', 'desc')->get();
        $data['taxes'] = Tax::orderBy('id', 'desc')->get();

        $data['product_type'] = $type;
        $data['sku'] = 'SKU-' . strtoupper(Str::random(6));

        if ($type === 'digital') {
            return view('frontend.vendor.products.create-digital', $data);
        }

        return view('frontend.vendor.products.create', $data);
    }

    public function store(Request $request)
    {
        $user = auth('customer')->user();
        if (!$user) {
            return response()->json(['status' => false, 'message' => 'Unauthorized.'], 422);
        }

        // Check KYC status first
        if ($user->kyc_status !== 'approved' && $user->kyc_status !== 'verified') {
            return response()->json([
                'status' => false,
                'message' => 'Your KYC is ' . ($user->kyc_status ?? 'pending') . '. Please complete your KYC to add products.'
            ], 200);
        }

        // Check Administrative approval
        if (!$user || !$user->vendor_verified_at) {
            return response()->json([
                'status' => false,
                'message' => 'Please wait for administrative approval before adding products.'
            ], 200);
        }

        $request->validate([
            'name' => 'required|string|max:191',
            'sku' => 'nullable|string|max:191|unique:ec_products,sku',
            'price' => 'nullable|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'quantity' => 'nullable|integer|min:0',
            'minimum_order_quantity' => 'nullable|integer|min:1',
            'maximum_order_quantity' => 'nullable|integer|min:0',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video_file' => 'nullable|mimes:mp4,mov,ogg,qt|max:20000',
        ]);

        DB::beginTransaction();

        try {
            $data = $request->except(['image_file', 'images', 'video_file', 'options', 'related_products', 'up_selling_products', 'cross_selling_products', 'selected_existing_faqs', 'categories']);

            $data['slug'] = Str::slug($request->name) . '-' . time();
            $data['status'] = 'pending';
            $data['created_by_id'] = $user->id;
            $data['created_by_type'] = Customer::class;

            // Set Vendor's Store
            $store = $user->store;
            if ($store) {
                $data['store_id'] = $store->id;
            }

            // Handle Featured Image
            if ($request->hasFile('image_file')) {
                $ImageUpload = ImageHelper::imageUploadHelper('product', $request->file('image_file'));
                if ($ImageUpload['status']) {
                    $data['image'] = $ImageUpload['data']['target_file'];
                }
            }

            // Handle Gallery Images
            if ($request->hasFile('images')) {
                $galleryImages = [];
                foreach ($request->file('images') as $file) {
                    $ImageUpload = ImageHelper::imageUploadHelper('gallery', $file);
                    if ($ImageUpload['status']) {
                        $galleryImages[] = $ImageUpload['data']['target_file'];
                    }
                }
                $data['images'] = $galleryImages;
            }

            // Handle Video
            if ($request->hasFile('video_file')) {
                $ImageUpload = ImageHelper::imageUploadHelper('video', $request->file('video_file'));
                if ($ImageUpload['status']) {
                    $data['video_media'] = [['file' => $ImageUpload['data']['target_file']]];
                }
            }

            if ($request->has('faq_schema_config')) {
                $data['faq_schema_config'] = array_values($request->input('faq_schema_config', []));
            }

            if ($request->has('taxes') && is_array($request->input('taxes'))) {
                $data['tax_id'] = $request->input('taxes')[0] ?? null;
            }

            $product = EcProduct::create($data);

            // Handle Digital Files if digital product
            if ($request->product_type === 'digital' && $request->hasFile('digital_files')) {
                foreach ($request->file('digital_files') as $file) {
                    $FileUpload = ImageHelper::imageUploadHelper('digital', $file);
                    if ($FileUpload['status']) {
                        EcProductFile::create([
                            'product_id' => $product->id,
                            'url' => $FileUpload['data']['target_file'],
                            'extras' => json_encode(['size' => $file->getSize(), 'name' => $file->getClientOriginalName()]),
                        ]);
                    }
                }
            }

            // Sync categories
            if ($request->has('categories')) {
                $product->categories()->sync($request->input('categories'));
            }

            // Save Options
            $this->saveOptions($product, $request);

            // Save Attributes
            $this->saveAttributes($product, $request);

            // Sync Relations & FAQs
            $this->syncProductRelations($product, $request);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Product created successfully and is pending approval.',
                'redirect' => route('frontend.vendor.products.index')
            ]);

        }
        catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Error: ' . $e->getMessage() . ' in ' . $e->getFile() . ' on line ' . $e->getLine()
            ], 500);
        }
    }

    public function edit(EcProduct $product)
    {
        $userId = auth('customer')->id();
        // Ensure the product belongs to the vendor
        if ($product->created_by_id != $userId || $product->created_by_type != Customer::class) {
            abort(403);
        }

        $data['categories'] = EcProductCategory::orderBy('id', 'desc')->get();
        $data['brands'] = EcBrand::orderBy('id', 'desc')->get();
        $data['tables'] = EcSpecificationTable::orderBy('id', 'desc')->get();
        $data['attributes'] = ProductAttribute::orderBy('id', 'desc')->get();
        $data['attributeSets'] = ProductAttributeSet::orderBy('id', 'desc')->get();
        $data['options'] = Option::orderBy('id', 'desc')->get();
        $data['optionsValues'] = OptionValue::orderBy('id', 'desc')->get();
        $data['globalOptions'] = GlobalOption::orderBy('id', 'desc')->get();
        $data['globalOptionsValue'] = GlobalOptionValue::orderBy('id', 'desc')->get();
        $data['faqs'] = AppFaq::orderBy('id', 'desc')->get();
        $data['collections'] = ProductCollection::orderBy('id', 'desc')->get();
        $data['productionlabels'] = ProductLabel::orderBy('id', 'desc')->get();
        $data['taxes'] = Tax::orderBy('id', 'desc')->get();

        $data['product'] = $product;

        return view('frontend.vendor.products.edit', $data);
    }

    public function update(Request $request, EcProduct $product)
    {
        $userId = auth('customer')->id();
        // Ensure the product belongs to the vendor
        if ($product->created_by_id != $userId || $product->created_by_type != Customer::class) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:191',
            'sku' => 'nullable|string|max:191|unique:ec_products,sku,' . $product->id,
            'price' => 'nullable|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'quantity' => 'nullable|integer|min:0',
            'minimum_order_quantity' => 'nullable|integer|min:1',
            'maximum_order_quantity' => 'nullable|integer|min:0',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video_file' => 'nullable|mimes:mp4,mov,ogg,qt|max:20000',
        ]);

        DB::beginTransaction();

        try {
            $data = $request->except(['image_file', 'images', 'video_file', 'options', 'related_products', 'up_selling_products', 'cross_selling_products', 'selected_existing_faqs', 'categories']);

            $data['slug'] = Str::slug($request->name) . '-' . time();
            $data['status'] = 'pending'; // Force pending on update too? Or keep current? Admin might want to re-approve.

            // Handle Featured Image
            if ($request->hasFile('image_file')) {
                $ImageUpload = ImageHelper::imageUploadHelper('product', $request->file('image_file'));
                if ($ImageUpload['status']) {
                    $data['image'] = $ImageUpload['data']['target_file'];
                }
            }

            // Handle Gallery Images
            if ($request->hasFile('images')) {
                $galleryImages = $product->images && is_array($product->images) ? $product->images : [];
                foreach ($request->file('images') as $file) {
                    $ImageUpload = ImageHelper::imageUploadHelper('gallery', $file);
                    if ($ImageUpload['status']) {
                        $galleryImages[] = $ImageUpload['data']['target_file'];
                    }
                }
                $data['images'] = $galleryImages;
            }

            // Handle Video
            if ($request->hasFile('video_file')) {
                $ImageUpload = ImageHelper::imageUploadHelper('video', $request->file('video_file'));
                if ($ImageUpload['status']) {
                    $data['video_media'] = [['file' => $ImageUpload['data']['target_file']]];
                }
            }

            if ($request->has('faq_schema_config')) {
                $data['faq_schema_config'] = array_values($request->input('faq_schema_config', []));
            }
            else {
                $data['faq_schema_config'] = null;
            }

            if ($request->has('taxes') && is_array($request->input('taxes'))) {
                $data['tax_id'] = $request->input('taxes')[0] ?? null;
            }

            $product->update($data);

            // Sync categories
            if ($request->has('categories')) {
                $product->categories()->sync($request->input('categories'));
            }

            // Save Options
            $this->saveOptions($product, $request);

            // Save Attributes
            $this->saveAttributes($product, $request);

            // Sync Relations & FAQs
            $this->syncProductRelations($product, $request);

            // Handle Tags
            if ($request->has('tag')) {
                $tagInput = $request->input('tag');
                $tagsData = json_decode($tagInput, true);
                if (json_last_error() === JSON_ERROR_NONE && is_array($tagsData)) {
                    $tagIds = [];
                    foreach ($tagsData as $tagItem) {
                        if (!empty($tagItem['value'])) {
                            $tag = EcProductTag::firstOrCreate(['name' => $tagItem['value']]);
                            $tagIds[] = $tag->id;
                        }
                    }
                    $product->tags()->sync($tagIds);
                }
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Product updated successfully and is pending approval.',
                'redirect' => route('frontend.vendor.products.index')
            ]);

        }
        catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Error: ' . $e->getMessage() . ' in ' . $e->getFile() . ' on line ' . $e->getLine()
            ], 500);
        }
    }

    protected function syncProductRelations($product, $request)
    {
        $relations = [
            'related_products' => 'relatedProducts',
            'up_selling_products' => 'upSellingProducts',
            'cross_selling_products' => 'crossSellingProducts',
            'selected_existing_faqs' => 'productFaqs',
            'product_collections' => 'productCollections',
            'product_labels' => 'productLabels',
            'categories' => 'categories',
        ];

        foreach ($relations as $inputKey => $relationMethod) {
            if ($request->has($inputKey)) {
                $product->$relationMethod()->sync($request->input($inputKey, []));
            }
        }
    }

    protected function saveAttributes($product, $request)
    {
        if ($request->has('attributes')) {
            $attributeSets = [];
            $attributes = [];
            
            foreach ($request->input('attributes') as $item) {
                if (!empty($item['attribute_set_id'])) {
                    $attributeSets[] = $item['attribute_set_id'];
                }
                if (!empty($item['attribute_id'])) {
                    $attributes[] = $item['attribute_id'];
                }
            }

            if (method_exists($product, 'productAttributeSets')) {
                $product->productAttributeSets()->sync(array_unique($attributeSets));
            }
            if (method_exists($product, 'productAttributes')) {
                $product->productAttributes()->sync(array_unique($attributes));
            }
        }
    }

    protected function saveOptions($product, $request)
    {
        if ($request->has('options')) {
            // Delete existing options for update flow or just handle properly
            // For simplicity in this complex form, we might want to clear and re-save or match by ID.
            // Admin controller seems to just create new ones or match by name? 
            // Actually Admin controller's saveOptions is a bit naive.

            foreach ($request->options as $optionData) {
                if (empty($optionData['name'])) {
                    continue;
                }

                $option = Option::firstOrNew(['product_id' => $product->id, 'name' => $optionData['name']]);
                $option->option_type = $optionData['option_type'] ?? 'dropdown';
                $option->required = isset($optionData['required']) ? 1 : 0;
                $option->order = $optionData['order'] ?? 0;
                $option->save();

                if (isset($optionData['values'])) {
                    // It's better to clear old values if updating
                    $option->values()->delete();
                    foreach ($optionData['values'] as $valueData) {
                        if (empty($valueData['option_value'])) {
                            continue;
                        }

                        $value = new OptionValue();
                        $value->option_id = $option->id;
                        $value->option_value = $valueData['option_value'];
                        $value->affect_price = $valueData['affect_price'] ?? 0;
                        $value->affect_type = $valueData['affect_type'] ?? 0;
                        $value->order = $valueData['order'] ?? 0;
                        $value->save();
                    }
                }
            }
        }
    }

    public function destroy(EcProduct $product)
    {
        $userId = auth('customer')->id();
        if ($product->created_by_id != $userId || $product->created_by_type != Customer::class) {
            abort(403);
        }
        $product->delete();
        return response()->json(['status' => true, 'message' => 'Product deleted successfully.']);
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids', []);
        $user = auth('customer')->user();
        $store = Store::where('customer_id', $user->id)->first();

        EcProduct::whereIn('id', $ids)
            ->where('store_id', $store->id)
            ->delete();

        return response()->json(['status' => true, 'message' => 'Products deleted successfully.']);
    }

    public function getRelationProducts(Request $request)
    {
        $search = $request->input('search') ?: $request->input('q');
        $query = EcProduct::query();
        
        if ($search) {
            $query->where('name', 'like', '%' . $search . '%')
                  ->orWhere('sku', 'like', '%' . $search . '%');
        }

        $userId = auth('customer')->id();
        $products = $query->limit(20)->get();

        $results = [];
        foreach ($products as $product) {
            $results[] = [
                'id' => $product->id,
                'name' => $product->name,
                'text' => $product->name,
                'image' => $product->image_url,
            ];
        }

        return response()->json(['data' => $results, 'results' => $results]);
    }

    public function getSpecificationtablesData(Request $request)
    {
        $table = EcSpecificationTable::with('groups.attributes')->find($request->input('group_id'));

        if (!$table) {
            return response()->json(['data' => []]);
        }

        return response()->json(['data' => $table->groups]);
    }

    public function getAttributeValues(Request $request)
    {
        $attributeSetId = $request->input('attribute_set_id');
        $attributes = ProductAttribute::where('attribute_set_id', $attributeSetId)->get(['id', 'title as name']);

        return response()->json(['data' => $attributes]);
    }

    public function getGlobalOption($id = null)
    {
        if (!$id) {
            return response()->json(['status' => false, 'message' => 'No ID provided'], 400);
        }
        $option = GlobalOption::with('values')->find($id);
        if (!$option) {
            return response()->json(['status' => false, 'message' => 'Option not found'], 404);
        }
        return response()->json(['status' => true, 'data' => $option]);
    }

    public function getAllTags()
    {
        return response()->json(EcProductTag::all(['id', 'name']));
    }
}
