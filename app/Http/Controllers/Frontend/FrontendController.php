<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Category;
use App\Models\Product;
use App\Models\Attribute_values;
use App\Models\Attribute;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\Inventory;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Banner;
use App\Models\Label;
use App\Models\Video;
use App\Models\PrimaryCategory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Mail\ContactUsMail;
use App\Models\WhatsappConversation;
use App\Models\MapAttributesValueToCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Counter;

class FrontendController extends Controller
{
    public function home()
    {
        // $previousUrl = url()->previous();
        // Log::info('Previous URL: ' . $previousUrl);
    
        $data['banner'] = Banner::orderBy('id', 'desc')->get(['id', 'image_path_desktop', 'link_desktop', 'title']);
        $seriesAttribute = Attribute::where('title', 'Series')->first();
        $data['seriesValuesWithCategory'] = MapAttributesValueToCategory::where('attributes_id', $seriesAttribute->id)
            ->with([
                'attributeValue:id,name,slug,images',
                'category:id,title,slug'
            ])
            ->get();
        //return response()->json($data['seriesValuesWithCategory']);
        DB::disconnect();
        return view('frontend.index', compact('data'));
    }

    public function aboutUs()
    {
        return view('frontend.pages.about-us');
    }

    public function blog()
    {
        return view('frontend.pages.blog');
    }

    public function blogDetails()
    {
        return view('frontend.pages.blog-details');
    }

    public function contactUs()
    {
        return view('frontend.pages.contact-us');
    }

    public function contactUsStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone_number' => ['required', 'regex:/^[6-9]\d{9}$/'],
            'email' => 'nullable|email',
            'message' => 'nullable|string',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }
        try {
            $data = [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'mobile_number' => $request->input('phone_number'),
                'message' => $request->input('message'),
            ];
            Mail::to('rahulkumarmaurya464@gmail.com')->send(new ContactUsMail($data));

            return response()->json([
                'status' => 'success',
                'message' => 'Your enquiry has been sent successfully, Our team contact you shortly.'
            ]);
        } catch (\Exception $e) {
            Log::error('Error mail error: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong, please try again later.' . $e->getMessage()
            ], 500);
        }
    }

    public function collections(Request $request, $category_slug, $attributes_value_slug)
    {
        $category = Category::select('id', 'title', 'slug')->where('slug', $category_slug)->first();
        $attributeValue = Attribute_values::select('id', 'name', 'slug', 'attributes_id')->where('slug', $attributes_value_slug)->first();

        $attributId = $attributeValue->attributes_id;
        $attribute_top = Attribute::select('id', 'title')->where('id', $attributId)->first();

        /*Base products query*/
        $productsQuery = Product::select('products.id', 'products.title', 'products.slug', 'products.created_at')
            ->where('category_id', $category->id)
            ->where('product_status', 1);

        // Apply the top attribute filter
        $productsQuery->whereHas('attributes', function ($query) use ($attribute_top, $attributeValue) {
            $query->where('attributes_id', $attribute_top->id)
                ->whereHas('values', function ($q) use ($attributeValue) {
                    $q->where('attributes_value_id', $attributeValue->id);
                });
        });
        // Apply additional filters from the request
        $filters = $request->query();
        if (!empty($filters)) {
            foreach ($filters as $filterAttributeSlug => $filterValueSlugs) {
                if ($filterAttributeSlug !== $attribute_top->slug) {
                    if (is_string($filterValueSlugs)) {
                        $filterValueSlugs = explode(',', $filterValueSlugs);
                    }
                    $attribute = Attribute::where('slug', $filterAttributeSlug)->first();
                    if (!$attribute) {
                        Log::warning("Attribute not found for slug: {$filterAttributeSlug}");
                        continue;
                    }
                    $valueIds = Attribute_values::whereIn('slug', $filterValueSlugs)->pluck('id')->toArray();
                    $productsQuery->whereHas('attributes', function ($query) use ($attribute, $valueIds) {
                        $query->where('attributes_id', $attribute->id)
                            ->whereHas('values', function ($q) use ($valueIds) {
                                $q->whereIn('attributes_value_id', $valueIds);
                            });
                    });
                }
            }
        }
        if ($request->has('sort')) {
            $sortOption = $request->get('sort');
            switch ($sortOption) {
                case 'new-arrivals':
                    $productsQuery->orderBy('created_at', 'desc');
                    break;
                case 'price-low-to-high':
                    $productsQuery->orderByRaw('ISNULL(inventories.mrp), inventories.mrp ASC');
                    break;
                case 'price-high-to-low':
                    $productsQuery->orderByRaw('ISNULL(inventories.mrp), inventories.mrp DESC');
                    break;
                case 'a-to-z-order':
                    $productsQuery->orderBy('products.title', 'asc');
                    break;
                default:
                    $productsQuery->orderBy('products.id', 'desc');
                    break;
            }
        } else {
            //$productsQuery->orderByRaw('ISNULL(inventories.mrp), inventories.mrp ASC');
            $productsQuery->orderBy('created_at', 'desc');
        }
        /*Fetch attributes with values for the filter list (mapped attributes and counts)*/
        $attributes_with_values_for_filter_list = $category->attributes()
        ->with(['AttributesValues' => function ($query) use ($category, $attribute_top, $attributeValue) {
            $query->whereHas('map_attributes_value_to_categories', function ($q) use ($category) {
                $q->where('category_id', $category->id);
            })
                ->withCount(['productAttributesValues' => function ($q) use ($category, $attribute_top, $attributeValue) {
                    // Calculate counts based on the filtered products query
                    $q->whereHas('product', function ($q) use ($category, $attribute_top, $attributeValue) {
                        $q->where('category_id', $category->id)
                            ->whereHas('attributes', function ($query) use ($attribute_top, $attributeValue) {
                                $query->where('attributes_id', $attribute_top->id)
                                    ->whereHas('values', function ($q) use ($attributeValue) {
                                        $q->where('attributes_value_id', $attributeValue->id);
                                    });
                            });
                    });
                }])
                ->having('product_attributes_values_count', '>', 0)
                ->orderBy('name');
        }])
        ->orderBy('title')
        ->get();


        $products = $productsQuery
            ->with([
                'category:id,title,slug',
                'images' => function ($query) {
                    $query->select('id', 'product_id', 'image_path')->orderBy('sort_order');
                },
                'ProductAttributesValues' => function ($query) {
                    $query->select('id', 'product_id', 'product_attribute_id', 'attributes_value_id')
                        ->with([
                            'attributeValue:id,slug,name',
                        ])
                        ->orderBy('id');
                },
            ])
            ->leftJoin('inventories', function ($join) {
                $join->on('products.id', '=', 'inventories.product_id')
                    ->whereRaw('inventories.mrp = (SELECT MIN(mrp) FROM inventories WHERE product_id = products.id)');
            })
            ->addSelect([
                'inventories.mrp',
                'inventories.offer_rate',
                'inventories.purchase_rate',
                'inventories.sku',
            ])
            ->paginate(4);
        if ($request->ajax()) {
            if ($request->has('load_more') && $request->get('load_more') == true) {
                return response()->json([
                    'products' => view('frontend.pages.partials.product-catalog-load-more', compact('products', 'attributes_with_values_for_filter_list'))->render(),
                    'hasMore' => $products->hasMorePages(),
                ]);
            } else {
                return response()->json([
                    'products' => view('frontend.pages.ajax-product-catalog', compact('products', 'attributes_with_values_for_filter_list'))->render(),
                    'hasMore' => $products->hasMorePages(),
                ]);
            }
        }
        DB::disconnect();
        //return response()->json($products);
        return view('frontend.pages.collections',
        compact(
            'products',
            'attributeValue',
            'category',
            'attributes_with_values_for_filter_list',
        ));
    }

    public function showProductDetails(Request $request, $slug, $attributes_value_slug)
    {
        $attributeValue = Attribute_values::where('slug', $attributes_value_slug)->first();
        /*First get the product and increment visitor count in one query*/
        $product = Product::where('slug', $slug)
        ->firstOrFail()
        ->increment('visitor_count');
        /*First get the product and increment visitor count in one query*/
       
        if (!$attributeValue) {
            $attributeValue = '';
        }
        $data['attributes_value_name'] = $attributeValue;
        $data['product_details'] = Product::with([
            'images' => function ($query) {
                $query->orderBy('sort_order');
            },
            'category',
            'brand',
            'attributes.attribute',
            'attributes.values.attributeValue',
            'additionalFeatures.feature'
        ])
            ->leftJoin('inventories', function ($join) {
                $join->on('products.id', '=', 'inventories.product_id')
                    ->whereRaw('inventories.mrp = (SELECT MIN(mrp) FROM inventories WHERE product_id = products.id)');
            })
            ->select('products.*', 'inventories.mrp', 'inventories.offer_rate', 'inventories.purchase_rate', 'inventories.sku', 'inventories.stock_quantity')
            ->where('products.slug', $slug)
            ->firstOrFail();
        
        $categoryId = $data['product_details']->category->id;
        
        $data['related_products'] = Product::with([
            'images' => function ($query) {
                $query->orderBy('sort_order');
            },
            'category',
            'ProductImagesFront:id,product_id,image_path',
            'ProductAttributesValues' => function ($query) use ($attributeValue) {
                $query->select('id', 'product_id', 'product_attribute_id', 'attributes_value_id')
                    ->where('attributes_value_id', $attributeValue->id)
                    ->with([
                        'attributeValue:id,slug'
                    ])
                    ->orderBy('id');
            }
        ])
            ->leftJoin('inventories', function ($join) {
                $join->on('products.id', '=', 'inventories.product_id')
                    ->whereRaw('inventories.mrp = (SELECT MIN(mrp) FROM inventories WHERE product_id = products.id)');
            })
            ->select('products.*', 'inventories.mrp', 'inventories.offer_rate', 'inventories.purchase_rate', 'inventories.sku')
            ->where('products.category_id', $categoryId)
            ->whereHas('productAttributesValues', function ($query) use ($attributeValue) {
                $query->where('attributes_value_id', $attributeValue->id);
            })
            ->inRandomOrder()
            ->limit(10)
            ->get();
			DB::disconnect();
        /**Related product display */
        //return response()->json($data['product_details']);
        return view('frontend.pages.products', compact('data'));
    }
}
