<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AppFaq;
use App\Models\EcBrand;
use App\Models\EcProduct;
use App\Models\EcProductCategory;
use App\Models\EcProductTag;
use App\Models\EcSpecificationTable;
use App\Models\GlobalOption;
use App\Models\GlobalOptionValue;
use App\Models\Option;
use App\Models\OptionValue;
use App\Models\ProductAttribute;
use App\Models\ProductAttributeSet;
use App\Models\ProductCollection;
use App\Models\ProductLabel;
use App\Models\Store;
use App\Models\Tax;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\ImageHelper;
use App\Helpers\TableHelpers;


class ProductController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index(Request $request)
    {
        $query = EcProduct::with(['brand', 'store']);

        TableHelpers::applyTableLogic($query, $request,
        ['id', 'name', 'sku', 'price', 'status', 'brand.name', 'store.name'],
        ['id', 'status', 'brand_id', 'store_id', 'created_at']
        );

        $products = $query->orderBy('id', 'desc')->paginate(TableHelpers::getPerPage($request));

        $filterColumns = [
            'id' => 'ID',
            'name' => 'Name',
            'sku' => 'SKU',
            'price' => 'Price',
            'status' => 'Status',
            'brand_id' => 'Brand',
            'store_id' => 'Store',
            'created_at' => 'Created At',
        ];

        return view('admin-layouts.product.product.index', compact('products', 'filterColumns'));
    }

    public function create()
    {
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
        $data['stores'] = Store::orderBy('id', 'desc')->get();
        $data['collections'] = ProductCollection::orderBy('id', 'desc')->get();
        $data['productionlabels'] = ProductLabel::orderBy('id', 'desc')->get();
        $data['taxes'] = Tax::orderBy('id', 'desc')->get();
        return view('admin-layouts.product.product.create', $data);
    }

    public function getRelationProducts(Request $request)
    {
        $term = $request->get('q');
        $products = EcProduct::where('name', 'LIKE', '%' . $term . '%')
            ->select('id', 'name', 'images')
            ->paginate(10);

        $results = [];
        foreach ($products as $product) {
            $images = $product->images;
            $image = is_array($images) && !empty($images) ? $images[0] : null;
            $imageUrl = $image ? asset('storage/' . $image) : asset('vendor/core/core/base/images/placeholder.png'); // Fallback image

            $results[] = [
                'id' => $product->id,
                'text' => $product->name,
                'image' => $imageUrl,
            ];
        }

        return response()->json(['results' => $results]);
    }

    public function getAllTags()
    {
        return EcProductTag::pluck('name')->all();
    }

    public function getSpecificationtablesData(Request $post)
    {
        try {
            $rules = array(
                'group_id' => 'required|integer|exists:ec_specification_tables,id',
            );
            $validator = \Validator::make($post->all(), $rules);
            if ($validator->fails()) {
                return response()->json(['success' => false, 'message' => 'Validation failed: ' . $validator->errors()->first()], 400);
            }

            $table = EcSpecificationTable::with(['groups.attributes'])->where('id', $post->group_id)->first();

            if (!$table) {
                return response()->json(['success' => false, 'message' => 'Specification table not found.'], 404);
            }

            return response()->json(['success' => true, 'data' => $table->groups], 200);
        }
        catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error fetching data: ' . $e->getMessage()], 500);
        }
    }

    public function getAttributeValues(Request $request)    {
        $values = DB::table('ec_product_attributes')
            ->where('attribute_set_id', $request->attribute_set_id)
            ->orderBy('order')
            ->get(['id', 'title']);

        return response()->json([
            'data' => $values
        ]);    }






    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:191',
            'sku' => 'nullable|string|max:191|unique:ec_products,sku',
            'price' => 'nullable|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'quantity' => 'nullable|integer|min:0',
            'status' => 'required|string|max:60',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video_file' => 'nullable|mimes:mp4,mov,ogg,qt|max:20000',
        ]);

        DB::beginTransaction();

        try {
            $data = $request->except(['image_file', 'images', 'video_file', 'options', 'related_products', 'up_selling_products', 'cross_selling_products', 'selected_existing_faqs']);

            $data['slug'] = \Illuminate\Support\Str::slug($request->name);

            // Force Pending for Vendors
            if (auth()->check() && auth()->user()->role === 'vendor') {
                $data['status'] = 'pending';
            }

            // 2. Handle Featured Image
            if ($request->hasFile('image_file')) {
                $data['image'] = $request->file('image_file')->store('products', 'public');
            }

            // 3. Handle Gallery Images
            if ($request->hasFile('images')) {
                $galleryImages = [];
                foreach ($request->file('images') as $file) {
                    $galleryImages[] = $file->store('products', 'public');
                }
                $data['images'] = $galleryImages;
            }

            // 4. Handle Video
            if ($request->hasFile('video_file')) {
                $videoPath = $request->file('video_file')->store('products/videos', 'public');
                $data['video_media'] = [['file' => $videoPath]];
            }

            // Defaults
            $data['created_by_id'] = auth()->id() ?? 0;
            $data['created_by_type'] = 'App\Models\User';

            if ($request->has('faq_schema_config')) {
                $data['faq_schema_config'] = array_values($request->input('faq_schema_config', []));
            }

            // Handle Tax ID (Schema has single tax_id, form has taxes[])
            if ($request->has('taxes') && is_array($request->input('taxes'))) {
                $data['tax_id'] = $request->input('taxes')[0] ?? null;
            }

            // 5. Create Product
            $product = EcProduct::create($data);

            // 6. Save Options
            $this->saveOptions($product, $request);

            // 7. Sync Relations & FAQs
            $this->syncProductRelations($product, $request);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Product created successfully.',
            ]);

        }
        catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Error: ' . $e->getMessage(),
                'errors' => [$e->getMessage()]
            ]);
        }
    }

    public function edit(EcProduct $product)
    {
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
        $data['stores'] = Store::orderBy('id', 'desc')->get();
        $data['collections'] = ProductCollection::orderBy('id', 'desc')->get();
        $data['productionlabels'] = ProductLabel::orderBy('id', 'desc')->get();
        $data['taxes'] = Tax::orderBy('id', 'desc')->get();

        $data['product'] = $product;

        return view('admin-layouts.product.product.edit', $data);
    }

    public function update(Request $request, EcProduct $product)
    {
        $request->validate([
            'name' => 'required|string|max:191',
            'sku' => 'nullable|string|max:191|unique:ec_products,sku,' . $product->id,
            'price' => 'nullable|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'quantity' => 'nullable|integer|min:0',
            'status' => 'required|string|max:60',
            // ... keys
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video_file' => 'nullable|mimes:mp4,mov,ogg,qt|max:20000',
        ]);
        DB::beginTransaction();

        try {
            $data = $request->except(['image_file', 'images', 'video_file', 'options', 'related_products', 'up_selling_products', 'cross_selling_products', 'selected_existing_faqs']);

            $data['slug'] = \Illuminate\Support\Str::slug($request->name);

            // Force Pending for Vendors
            if (auth()->check() && auth()->user()->role === 'vendor') {
                $data['status'] = 'pending';
            }

            // 1. Handle Featured Image
            if ($request->hasFile('image_file')) {
                $ImageUpload = ImageHelper::imageUploadHelper('product', $request->file('image_file'));
                if ($ImageUpload['status']) {
                    $data['image'] = $ImageUpload['data']['target_file'];
                }
            }

            // 2. Handle Gallery Images
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

            // 3. Handle Video
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

            // Handle Tax ID
            if ($request->has('taxes') && is_array($request->input('taxes'))) {
                $data['tax_id'] = $request->input('taxes')[0] ?? null;
            }

            $product->update($data);

            // Save Options
            $this->saveOptions($product, $request);

            // Sync Relations & FAQs
            $this->syncProductRelations($product, $request);

            // Handle Tags
            if ($request->has('tag')) {
                $tagInput = $request->input('tag');
                // Check if it is a JSON string
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
                'message' => 'Product updated successfully.',
                'redirect' => route('admin.products.index')
            ]);

        }
        catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Error: ' . $e->getMessage()
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
        ];

        foreach ($relations as $inputKey => $relationMethod) {
            $product->$relationMethod()->sync($request->input($inputKey, []));
        }
    }

    protected function saveOptions($product, $request)
    {
        if ($request->has('options')) {
            foreach ($request->options as $optionData) {
                // Ensure option name is provided
                if (empty($optionData['name'])) {
                    continue;
                }

                // Check if option exists or create new (Use firstOrNew to be safe for updates too, or just new for store)
                // Using firstOrNew logic to support both Create and Update flows if reused
                $option = Option::firstOrNew(['product_id' => $product->id, 'name' => $optionData['name']]);
                $option->option_type = $optionData['option_type'] ?? 'dropdown';
                $option->required = isset($optionData['required']) ? 1 : 0;
                $option->order = $optionData['order'] ?? 0;
                $option->save();

                if (isset($optionData['values'])) {
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
        return TableHelpers::performDelete($product, EcProduct::class , 'product');
    }

    public function show(EcProduct $product)
    {
        $product->load(['brand', 'categories', 'productCollections', 'productLabels', 'tags', 'store']);

        $stats = [
            'views' => $product->views ?? 0,
            'completed_orders' => 0, // Placeholder
            'total_sold' => 0, // Placeholder
            'revenue' => 0, // Placeholder
            'pending_orders' => 0, // Placeholder
            'pending_revenue' => 0, // Placeholder
            'conversion_rate' => 0.00, // Placeholder
            'reviews_count' => $product->reviews_count ?? 0,
            'average_rating' => $product->reviews_avg ?? 0,
        ];

        // Fetch real data for placeholders
        $recentOrders = DB::table('ec_orders')
            ->join('ec_order_product', 'ec_orders.id', '=', 'ec_order_product.order_id')
            ->leftJoin('payments', 'ec_orders.payment_id', '=', 'payments.id')
            ->leftJoin('ec_customers', 'ec_orders.user_id', '=', 'ec_customers.id')
            ->where('ec_order_product.product_id', $product->id)
            ->select(
                'ec_orders.id', 'ec_orders.status', 'ec_orders.created_at',
                'ec_customers.name as customer_name',
                'ec_order_product.qty', 'ec_order_product.price as product_price',
                'payments.status as payment_status'
            )
            ->orderBy('ec_orders.created_at', 'desc')
            ->take(10)
            ->get();

        $relatedProducts = $product->relatedProducts()->with('brand')->take(5)->get();

        return view('admin-layouts.product.product.show', compact('product', 'stats', 'recentOrders', 'relatedProducts'));
    }

    public function bulkDelete(Request $request)
    {
        return TableHelpers::performBulkDelete($request, EcProduct::class , 'products');
    }


    public function approve($id)
    {
        $product = EcProduct::findOrFail($id);
        $product->status = 'published';
        $product->approved_by = auth()->id();
        $product->save();

        if (request()->ajax()) {
            return response()->json([
                'status' => true,
                'message' => 'Product approved successfully.'
            ]);
        }

        return redirect()->back()->with('success', 'Product approved successfully.');
    }
}
