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
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function searchModalOpen(Request $request)
    {
        $url = $request->input('url');
        $products = Product::where('product_status', 1)
            ->with([
                'images' => function ($query) {
                    $query->select('id', 'product_id', 'image_path')->orderBy('sort_order');
                },
                'ProductAttributesValues' => function ($query) {
                    $query->select('id', 'product_id', 'product_attribute_id', 'attributes_value_id')
                        ->with(['attributeValue:id,slug'])
                        ->orderBy('id');
                }
            ])
            ->leftJoin('inventories', function ($join) {
                $join->on('products.id', '=', 'inventories.product_id')
                    ->whereRaw('inventories.mrp = (SELECT MIN(mrp) FROM inventories WHERE product_id = products.id)');
            })
            ->select('products.*', 'inventories.mrp', 'inventories.offer_rate', 'inventories.purchase_rate', 'inventories.sku')
            ->get()
            ->shuffle();
        $data['random_products'] = $products->take(6);

        $searchModal = '
        <div class="row">
            <div class="col-xl-12">
                <div class="top-title">
                    <div class="title">Trending Searches</div>
                </div>
                <div class="tf-grid-layout tf-col-2 md-col-3 xl-col-3">';
        $defaultImage = asset('frontend/assets/himgiri-img/logo/1.png');
        $bgColors = ['#f5f5f5', '#fff3d9', '#f4e7fb', '#f4dcdc'];
        if (!empty($data['random_products']) && $data['random_products']->isNotEmpty()) {
            foreach ($data['random_products'] as $key => $product) {
                $firstImage = $product->images->get(0)?->image_path;
                $secondImage = $product->images->get(1)?->image_path;
                $image1 = $firstImage ? asset('images/product/thumb/' . $firstImage) : $defaultImage;
                $image2 = $secondImage ? asset('images/product/thumb/' . $secondImage) : $defaultImage;
                $attributes_value = 'na';
                if ($product->ProductAttributesValues->isNotEmpty()) {
                    $attributes_value = $product->ProductAttributesValues->first()->attributeValue->slug;
                }
                $searchModal .= '
                        <div class="card-product style-3 card-product-size">
                            <div class="card-product-wrapper" style="background-color: '.$bgColors[$key % count($bgColors)] .'; padding:10px;">
                                <a href="' . route('products', [
                                        'product_slug' => $product['slug'],
                                        'attributes_value_slug' => $attributes_value
                                    ]) . '" class="product-img">
                                    <img class="img-product lazyload"
                                        data-src="' . $image1 . '"
                                        src="' . $image1 . '" alt="' . $product->title . '" loading="lazy">
                                    <!--<img class="img-hover lazyload"
                                        data-src="' . $image2 . '"
                                        src="' . $image2 . '" alt="' . $product->title . '" loading="lazy">-->
                                </a>
                            </div>
                            <div class="card-product-info">
                                <a href="' . route('products', [
                    'product_slug' => $product['slug'],
                    'attributes_value_slug' => $attributes_value
                ]) . '" class="name-product link fw-medium text-md">
                                    ' . $product->title . '
                                </a>';
                if ($product->mrp) {
                    $searchModal .= '
                                    <span class="price-new text-primary">Rs. ' . $product->mrp . '</span>
                                    <!--<span class="price-old">Rs. ' . $product->mrp . '</span>-->
                                    ';
                } else {
                    $searchModal .= '
                                    <p class="price-wrap fw-medium">
                                        <span class="price-new text-primary">Price Not Available .</span>
                                    </p>';
                }
                $searchModal .= '
                            </div>
                        </div>';
            }
        }
        $searchModal .= '
                </div>
            </div>
        </div>
        ';
        return response()->json([
            'message' => 'Search modal Created Successfully',
            'searchModel' => $searchModal,
        ]);
    }

    public function searchSuggestions(Request $request)
    {
        $query = $request->get('query');
        $searchTerms = explode(' ', $query);
        $booleanQuery = '+' . implode(' +', $searchTerms);
        $products = Product::whereRaw("MATCH(title) AGAINST(? IN BOOLEAN MODE)", [$booleanQuery])
            ->orWhere(function ($query) use ($searchTerms) {
                foreach ($searchTerms as $term) {
                    $query->where('title', 'like', '%' . $term . '%');
                }
            })
            ->with('firstImage')
            ->limit(15)
            ->get(['id', 'title']);

        $suggestions = $products->map(function ($product) {
            $image = $product->images->first();
            return [
                'title' => ucwords(strtolower($product->title)),
                'image' => $image ? asset('images/product/icon/' . $image->image_path) : null,
            ];
        });
        DB::disconnect();
        return response()->json(['suggestions' => $suggestions]);
    }


    public function searchListProduct(Request $request)
    {
        $query = $request->get('query');
        $category = $request->get('category');

        if (!$query) {
            // return redirect('/');
        }

        $searchTerms = array_filter(explode(' ', $query));
        $booleanQuery = '+' . implode(' +', $searchTerms);

        $productsQuery = Product::leftJoin('inventories', function ($join) {
            $join->on('products.id', '=', 'inventories.product_id')
                ->whereRaw('inventories.mrp = (SELECT MIN(mrp) FROM inventories WHERE product_id = products.id)');
        })
            ->select('products.*', 'inventories.mrp', 'inventories.offer_rate', 'inventories.purchase_rate', 'inventories.sku')
            ->whereRaw("MATCH(title) AGAINST(? IN BOOLEAN MODE)", [$booleanQuery])
            ->orWhere(function ($query) use ($searchTerms) {
                foreach ($searchTerms as $term) {
                    $query->where('title', 'like', '%' . $term . '%');
                }
            })
            ->with([
                'images' => function ($query) {
                    $query->orderBy('sort_order');
                },
                'ProductImagesFront:id,product_id,image_path',
                'ProductAttributesValues' => function ($query) {
                    $query->select('id', 'product_id', 'product_attribute_id', 'attributes_value_id')
                        ->with(['attributeValue:id,slug'])
                        ->orderBy('id');
                }
            ]);

        if ($category) {
            $categoryIds = explode(',', $category);
            $productsQuery->whereIn('category_id', $categoryIds);
        }

        $products = $productsQuery->paginate(100);

        $categories = Category::whereHas('products', function ($query) use ($searchTerms) {
            foreach ($searchTerms as $term) {
                $query->where('title', 'like', '%' . $term . '%');
            }
        })->orderBy('created_at', 'desc')->get();

        DB::disconnect();

        return view('frontend.pages.search-catalog', [
            'products' => $products,
            'categories' => $categories,
            'query' => $query
        ]);
    }
}
