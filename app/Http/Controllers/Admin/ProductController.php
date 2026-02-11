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


class ProductController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index(Request $request)
    {
        $data['products'] = EcProduct::with(['brand', 'store'])->orderBy('id', 'desc')->get();
        return view('admin-layouts.product.product.index',$data);
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
        return view('admin-layouts.product.product.create',$data);
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

    public function getSpecificationtablesData(Request $post){
        try{
            $rules = array(
                'group_id' => 'required|integer|exists:ec_specification_tables,id',
            );
            $validator = \Validator::make($post->all(), $rules);
            if ($validator->fails()) {
                return response()->json(['success' => false, 'message' => 'Validation failed: ' . $validator->errors()->first()], 400);
            }

            $table = EcSpecificationTable::with(['groups.attributes'])->where('id', $post->group_id)->first();

            if(!$table){
                return response()->json(['success' => false, 'message' => 'Specification table not found.'], 404);
            }

            return response()->json(['success' => true, 'data' => $table->groups], 200);
        }catch(Exception $e){
            return response()->json(['success' => false, 'message' => 'Error fetching data: ' . $e->getMessage()], 500);
        }
    }


public function getAttributeValues(Request $request)
{
    $values = DB::table('ec_product_attributes')
        ->where('attribute_set_id', $request->attribute_set_id)
        ->orderBy('order')
        ->get(['id', 'title']);

    return response()->json([
        'data' => $values
    ]);
}






    public function store(Request $request)
    {
        // 1. Validation
        $request->validate([
            'name' => 'required|string|max:191',
            'sku' => 'nullable|string|max:191|unique:ec_products,sku',
            'price' => 'nullable|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'quantity' => 'nullable|integer|min:0',
            'status' => 'required|string|max:60',
            // ... other validations can remain or be expanded
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate gallery images
            'video_file' => 'nullable|mimes:mp4,mov,ogg,qt|max:20000',      // Validate video
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
                $data['images'] = $galleryImages; // Model should cast this to array/json
            }

            // 4. Handle Video
            if ($request->hasFile('video_file')) {
                // Storing as array to mimic repeater structure if necessary, or just path
                // Assuming simple path for now, or adapt based on model usage
                $videoPath = $request->file('video_file')->store('products/videos', 'public');
                 // If previous was repeater, it might expect [[ 'file' => ... ]]
                 // For now, let's save the path. If model casts to array, Laravel handles string->array? No. 
                 // Let's safe-guard:
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
                'redirect' => route('admin.products.index')
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Error: ' . $e->getMessage(),
                'errors' => [$e->getMessage()] 
            ], 500);
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

            if ($request->hasFile('image_file')) {
                $data['image'] = $request->file('image_file')->store('products', 'public');
            }

          
            if ($request->hasFile('images')) {
                $galleryImages = $product->images && is_array($product->images) ? $product->images : [];
                foreach ($request->file('images') as $file) {
                    $galleryImages[] = $file->store('products', 'public');
                }
                $data['images'] = $galleryImages; 
            }

             if ($request->hasFile('video_file')) {
                 $videoPath = $request->file('video_file')->store('products/videos', 'public');
                 $data['video_media'] = [['file' => $videoPath]]; 
            }

             if ($request->has('faq_schema_config')) {
                $data['faq_schema_config'] = array_values($request->input('faq_schema_config', []));
            } else {
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

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Product updated successfully.',
                'redirect' => route('admin.products.index')
            ]);

        } catch (\Exception $e) {
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
            'related_products'       => 'relatedProducts',
            'up_selling_products'    => 'upSellingProducts',
            'cross_selling_products' => 'crossSellingProducts',
            'selected_existing_faqs' => 'productFaqs',
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
        DB::beginTransaction();
        try {
            $product->delete();
            
            // Optionally delete related data if not handled by foreign keys or model events
            // $product->options()->delete(); 
            // $product->relatedProducts()->detach();
            // etc.

            DB::commit();

            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Product deleted successfully.'
                ]);
            }

            return redirect()->route('admin.products.index')->with('success', 'Product deleted.');
        } catch (\Exception $e) {
            DB::rollBack();
            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error: ' . $e->getMessage()
                ], 500);
            }
            return redirect()->route('admin.products.index')->with('error', 'Error deleting product.');
        }
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids', []);
        if (empty($ids)) {
            return response()->json(['success' => false, 'message' => 'No products selected.'], 400);
        }

        DB::beginTransaction();
        try {
            EcProduct::whereIn('id', $ids)->delete();
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Selected products deleted successfully.'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }


}
