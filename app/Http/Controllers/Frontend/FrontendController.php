<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Category;
use App\Models\Product;
use App\Models\Attribute_values;
use App\Models\Attribute;
use App\Models\CustomerCareRequest;
use Intervention\Image\Facades\Image;
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
use Illuminate\Support\Facades\File;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
class FrontendController extends Controller
{
    public function home()
    {
        $data['banner'] = Banner::latest('id')->get(['id', 'image_path_desktop', 'link_desktop', 'title', 'image_path_mobile']);
        $data['primary_category'] = PrimaryCategory::where('status', 1)
            ->orderBy('title')
            ->get(['id', 'title', 'link']);
        [$seriesAttribute, $modelAttribute, $airCoolerCategory, $almirahCategory] = [
            Attribute::where('title', 'Series')->first(),
            Attribute::where('title', 'Model')->first(),
            Category::where('title', 'Air Coolers')->first(),
            Category::where('title', 'Almirah')->first()
        ];

        $data['seriesValuesWithCategory'] = MapAttributesValueToCategory::query()
            ->where('attributes_id', $seriesAttribute->id)
            ->where('category_id', $airCoolerCategory->id)
            ->with([
                'attributeValue:id,name,slug,images',
                'category:id,title,slug'
            ])
            ->get();

        $data['modelValuesWithCategory'] = MapAttributesValueToCategory::query()
            ->where('attributes_id', $modelAttribute->id)
            ->where('category_id', $almirahCategory->id)
            ->with([
                'attributeValue:id,name,slug,images',
                'category:id,title,slug'
            ])
            ->get();
        //return response()->json($data['modelValuesWithCategory']);
        DB::disconnect();
        return view('frontend.index', compact('data'));
    }

    public function aboutUs()
    {
        return view('frontend.pages.about-us');
    }

    public function blog()
    {
        $blogs = Blog::select('id', 'title', 'slug', 'bog_description', 'blog_image')->get();
        return view('frontend.pages.blog', compact('blogs'));
    }

    public function blogDetails($slug)
    {
        $blog = Blog::with([
            'category',
            'paragraphs.productLinks.product' => function ($query) {
                $query->with([
                    'images' => function ($query) {
                        $query->select('id', 'product_id', 'image_path')->orderBy('sort_order');
                    },
                    'ProductAttributesValues' => function ($query) {
                        $query->select('id', 'product_id', 'product_attribute_id', 'attributes_value_id')
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
                    ->select('products.*', 'inventories.mrp', 'inventories.offer_rate', 'inventories.purchase_rate', 'inventories.sku');
            }
        ])
            ->where('slug', $slug)
            ->firstOrFail();

        DB::disconnect();
        return view('frontend.pages.blog-details', compact('blog'));
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

    public function customerCare()
    {
        $category = Category::select('id', 'title', 'slug')->get();
        return view('frontend.pages.customer-care', compact('category'));
    }

    public function getModelsByCategory(Request $request)
    {
        $category_id = $request->category_id;
        $get_only_model_attributes = Attribute::where('title', 'Model')->first();
        $mappedValues = MapAttributesValueToCategory::where('category_id', $category_id)
            ->where('attributes_id', $get_only_model_attributes->id)
            ->with('attributeValue')
            ->get()
            ->pluck('attributeValue')
            ->filter();

        return response()->json($mappedValues->values());
    }

    public function customerCareDataStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category' => 'required|integer|exists:category,id',
            'model' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'problem_type' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone_number' => 'required|string|size:10',
            'product_image' => 'required|image|mimes:jpeg,png,jpg,webp|max:6144',
            'message' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $category = Category::findOrFail($request->category);
            $ticketId = strtoupper('TKT-' . Str::random(8));
            $imagePath = null;
            $pdfPath = null;

            if ($request->hasFile('product_image')) {
                $categoryName = preg_replace('/[^A-Za-z0-9\-]/', '', strtolower($category->title));
                $modelName = preg_replace('/[^A-Za-z0-9\-]/', '', strtolower($request->model));
                $image = $request->file('product_image');

                $baseFilename = $categoryName . '-' . $modelName . '-' . Str::random(5);
                $imageFilename = $baseFilename . '.jpg';

                $directory = public_path('uploads/customer-care');
                $directory_pdf = public_path('uploads/customer-care/pdf');
                if (!File::exists($directory)) {
                    File::makeDirectory($directory, 0755, true);
                }
                if (!File::exists($directory_pdf)) {
                    File::makeDirectory($directory_pdf, 0755, true);
                }
                $imageInstance = Image::make($image)->encode('jpg', 75);
                $imagePath = 'uploads/customer-care/' . $imageFilename;
                $imageInstance->save(public_path($imagePath));
                $careRequest = CustomerCareRequest::create([
                    'ticket_id' => $ticketId,
                    'category_name' => $category->title,
                    'model_name' => $request->model,
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone_number' => $request->phone_number,
                    'product_image' => $imageFilename,
                    'message' => $request->message,
                    'problem_type' => $request->problem_type,
                ]);

                $pdf = Pdf::loadView('frontend.emails.customer_care_pdf', ['careRequest' => $careRequest]);
                $pdfFilename = $baseFilename . '.pdf';
                $pdfPath = public_path('uploads/customer-care/pdf/' . $pdfFilename);
                $pdf->save($pdfPath);

                Mail::send('frontend.emails.customer_care_ticket', ['careRequest' => $careRequest], function ($message) use ($careRequest, $pdfPath) {
                    $message->to('rahulkumarmaurya464@gmail.com')
                        ->subject('New Customer Care Ticket: ' . $careRequest->ticket_id)
                        ->attach($pdfPath, [
                            'as' => 'CustomerCareTicket.pdf',
                            'mime' => 'application/pdf',
                        ]);
                });
                return response()->json([
                    'status' => 'success',
                    'message' => 'Your request has been submitted successfully. Our team contact you shortly. Your Ticket ID is ' . $ticketId . '.',
                ]);
            }

            return response()->json([
                'status' => 'error',
                'message' => 'Product image is required.',
            ], 400);
        } catch (\Exception $e) {
            Log::error('Customer Care Request Failed: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong. Please try again later.',
            ], 500);
        }
    }

    public function collections(Request $request, $category_slug, $attributes_value_slug)
    {
        $primary_category = PrimaryCategory::where('link', $request->url())->first();
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
            ->paginate(20);
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
        return view(
            'frontend.pages.collections',
            compact(
                'products',
                'attributeValue',
                'category',
                'primary_category',
                'attributes_with_values_for_filter_list',
            )
        );
    }

    public function showCategoryProduct(Request $request, $categorySlug)
    {
        try {
            $primary_category = PrimaryCategory::where('link', $request->url())->first();
            //Log::info('Filters: ' . json_encode($primary_category));
            $category = Category::where('slug', $categorySlug)->first();
            $productsQuery = Product::where('category_id', $category->id)->where('product_status', 1);

            /** for filter code */
            $filters = $request->query();
            if (!empty($filters)) {
                foreach ($filters as $attributeSlug => $valueSlugs) {
                    if (is_string($valueSlugs)) {
                        $valueSlugs = explode(',', $valueSlugs);
                    }
                    $attribute = Attribute::where('slug', $attributeSlug)->first();
                    if (!$attribute) {
                        Log::warning("Attribute not found for slug: {$attributeSlug}");
                        continue;
                    }
                    $valueIds = Attribute_values::whereIn('slug', $valueSlugs)->pluck('id')->toArray();
                    $productsQuery->whereHas('attributes', function ($query) use ($attribute, $valueIds) {
                        $query->where('attributes_id', $attribute->id)
                            ->whereHas('values', function ($q) use ($valueIds) {
                                $q->whereIn('attributes_value_id', $valueIds);
                            });
                    });
                }
            }

            $attributes_with_values_for_filter_list = $category->attributes()
                ->with(['AttributesValues' => function ($query) use ($category) {
                    $query->whereHas('map_attributes_value_to_categories', function ($q) use ($category) {
                        $q->where('category_id', $category->id);
                    })
                        ->withCount(['productAttributesValues' => function ($q) use ($category) {
                            $q->whereHas('product', function ($q) use ($category) {
                                $q->where('category_id', $category->id);
                            });
                        }])
                        //->having('product_attributes_values_count', '>', 0)
                        ->orderBy('name');
                }])
                ->orderBy('title')
                ->get();
            // Sorting logic
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

            // Fetching products with the necessary relationships
            $products = $productsQuery->with([
                'category',
                'images' => function ($query) {
                    $query->select('id', 'product_id', 'image_path')
                        ->orderBy('sort_order');
                },
                'ProductAttributesValues' => function ($query) {
                    $query->select('id', 'product_id', 'product_attribute_id', 'attributes_value_id')
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
                ->paginate(32);
            //dd($specialOffers);
            if ($request->ajax()) {
                if ($request->has('load_more') && $request->get('load_more') == true) {
                    return response()->json([
                        'products' => view('frontend.pages.partials.product-category-catalog-load-more', compact('products', 'attributes_with_values_for_filter_list'))->render(),
                        'hasMore' => $products->hasMorePages(),
                    ]);
                } else {
                    return response()->json([
                        'products' => view('frontend.pages.ajax-product-category-catalog', compact('products', 'attributes_with_values_for_filter_list'))->render(),
                        'hasMore' => $products->hasMorePages(),
                    ]);
                }
            }
            DB::disconnect();
            //return response()->json($primary_category);
            return view('frontend.pages.product-catalog-category', compact('products', 'category', 'attributes_with_values_for_filter_list', 'primary_category'));
        } catch (\Exception $e) {
            Log::error('Error fetching product catalog: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            return response()->json(['error' => 'Something went wrong.'], 500);
        }
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
        //return response()->json($data['related_products']);
        return view('frontend.pages.products', compact('data'));
    }

    public function privacyPolicy()
    {
        return view('frontend.pages.privacy-policy');
    }

    public function termsAndConditions()
    {
        return view('frontend.pages.terms-and-conditions');
    }

    public function productEnquiryModelForm(Request $request)
    {
        $product_id = $request->input('product_id');
        $product_image_path = $request->input('product_image_path');
        $product_title = $request->input('product_title');
        $form = '
            <div class="modal-top">
                <div class="p-en-p-name text-center mb-2 mt-2">
                    <h5 class="title">' . $product_title . '</h5>
                </div>
                <div class="product-image-modal">
                    <img class="lazyload" data-src="' . $product_image_path . '"
                    src="' . $product_image_path . '" alt="images">
                </div>
                <span class="icon icon-close btn-hide-popup" data-bs-dismiss="modal"></span>
            </div>
            <div class="modal-bottom newsletter">
                <div class="product-enquiry-form">
                    <form action="'.route('product-enquiry-model.submit').'" accept-charset="UTF-8" enctype="multipart/form-data" id="productEnquiryForm" class="form-default">
                        '.csrf_field().'
                        <input type="hidden" value="'.$product_title.'" name="product_name">
                        <input type="hidden" value="'.$product_image_path.'" name="image_path">
                        <div class="wrap">
                            <div class="cols">
                                <fieldset>
                                    <input id="enquiry_name" class="radius-8 form-control" type="text" name="enquiry_name" placeholder="Enter your name *">
                                </fieldset>
                            </div>
                            <div class="cols">
                                <fieldset>
                                    <input id="email" class="radius-8 form-control" type="email" name="email" placeholder="Enter your email" >
                                </fieldset>
                            </div>
                            <div class="cols">
                                <fieldset>
                                    <input id="phone_no" class="radius-8 form-control" type="text" name="phone_no" placeholder="Enter your phone/mobile No. *" maxlength="10" pattern="[0-9+\-\s()]+">
                                </fieldset>
                            </div>
                            <div class="cols">
                                <fieldset class="textarea">
                                    <textarea id="enquiry_message" class="radius-8 form-control" cols="20" name="enquiry_message" rows="2" placeholder="Enter message.."></textarea>
                                </fieldset>
                            </div>
                            <div class="button-submit">
                                <button class="tf-btn animate-btn" type="submit">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>  
            </div>
        ';
        return response()->json([
            'message' => 'Form created successfully',
            'form' => $form,
        ]);
    }

    public function productEnquiryModelFormSubmit(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'product_name' => 'required|string|max:255',
                'image_path' => 'required|string|max:255',
                'enquiry_name' => 'required|string|max:100',
                'email' => 'nullable|email|max:150',
                'phone_no' => [
                    'required',
                    'string',
                    'max:20',
                    'regex:/^[0-9+\-\s()]+$/'
                ],
                'enquiry_message' => 'nullable|string|max:1000',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'errors' => $validator->errors(),
                ], 422);
            }

            $data = $validator->validated();
            $imagePath = public_path($data['image_path']);
            $attachment = null;
            if (file_exists($imagePath)) {
                $attachment = $imagePath;
            }

            Mail::send('frontend.emails.product_enquiry', $data, function ($mail) use ($data, $attachment) {
                $mail->to('rahulkumarmaurya464@gmail.com', 'Admin')
                    ->subject('Product Enquiry: ' . $data['product_name']);
                
                if ($attachment) {
                    $mail->attach($attachment); 
                }
            });

            return response()->json([
                'status' => 'success',
                'message' => 'Enquiry submitted successfully. Our team will contact you shortly.',
            ]);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }


}
