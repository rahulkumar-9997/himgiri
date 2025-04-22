<?php
namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use App\Models\Category;
USE App\Models\Product;

class MenuComposer
{
    public function compose(View $view)
    {
        // Log::info("MenuComposer called from:", [
        //     'view' => $view->getName(),
        //     'trace' => debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 5)
        // ]);
        /*
        Log::info("MenuComposer triggered by view: ".$view->getName());
        $startTime = microtime(true);
        $categories = Category::with([
            'attributes.mappedCategoryToAttributesForFront',
            'attributes.AttributesValues.map_attributes_value_to_categories'
        ])->orderBy('title')->get();

        $formattedCategories = $categories->map(function ($category) {
            $attributesWithValues = [];
            $mappedAttributes = $category->attributes->filter(function ($attribute) use ($category) {
                return $attribute->mappedCategoryToAttributesForFront->contains('category_id', $category->id);
            })->sortBy('title');

            foreach ($mappedAttributes as $attribute) {
                $filteredValues = $attribute->AttributesValues->filter(function ($value) use ($category) {
                    return $value->map_attributes_value_to_categories->contains('id', $category->id);
                });

                if ($filteredValues->isNotEmpty()) {
                    $attributesWithValues[] = [
                        'title' => $attribute->title,
                        'slug' => $attribute->slug,
                        'values' => $filteredValues->map(function ($value) {
                            return [
                                'name' => $value->name,
                                'slug' => $value->slug
                            ];
                        })->values()
                    ];
                }
            }

            if (!empty($attributesWithValues)) {
                return [
                    'title' => $category->title,
                    'category-slug' => $category->slug,
                    'category-image' => $category->image,
                    'attributes' => $attributesWithValues
                ];
            }
        })->filter()->values();

        $endTime = microtime(true);
        $loadingTime = $endTime - $startTime;
        $view->with('categoriesWithMappedAttributesAndValues', $formattedCategories);
        */
        Log::info("MenuComposer triggered by view: " . $view->getName());
        $startTime = microtime(true);
        $categories = Category::with([
            'attributes.mappedCategoryToAttributesForFront',
            'attributes.AttributesValues.map_attributes_value_to_categories'
        ])->orderBy('title')->get();
        $formattedCategories = [];
        $categorySlugs = [];

        foreach ($categories as $category) {
            $attributesWithValues = [];

            $mappedAttributes = $category->attributes->filter(function ($attribute) use ($category) {
                return $attribute->mappedCategoryToAttributesForFront->contains('category_id', $category->id);
            })->sortBy('title');

            foreach ($mappedAttributes as $attribute) {
                $filteredValues = $attribute->AttributesValues->filter(function ($value) use ($category) {
                    return $value->map_attributes_value_to_categories->contains('id', $category->id);
                });

                if ($filteredValues->isNotEmpty()) {
                    $attributesWithValues[] = [
                        'title' => $attribute->title,
                        'slug' => $attribute->slug,
                        'values' => $filteredValues->map(function ($value) {
                            return [
                                'name' => $value->name,
                                'slug' => $value->slug
                            ];
                        })->values()
                    ];
                }
            }

            if (!empty($attributesWithValues)) {
                $formattedCategories[] = [
                    'title' => $category->title,
                    'category-slug' => $category->slug,
                    'category-image' => $category->image,
                    'attributes' => $attributesWithValues
                ];

                $categorySlugs[$category->id] = $category->slug;
            }
        }

        /*Get 2 random products per category*/
        $randomProductsByCategory = [];

        foreach (array_keys($categorySlugs) as $categoryId) {
            $products = Product::where('category_id', $categoryId)
                ->inRandomOrder()
                ->take(4)
                ->with([
                    'images' => fn($q) => $q->select('id', 'product_id', 'image_path')->orderBy('sort_order'),
                    'ProductAttributesValues' => fn($q) =>
                        $q->select('id', 'product_id', 'product_attribute_id', 'attributes_value_id')
                          ->with('attributeValue:id,slug')
                          ->orderBy('id')
                ])
                ->leftJoin('inventories', function ($join) {
                    $join->on('products.id', '=', 'inventories.product_id')
                        ->whereRaw('inventories.mrp = (SELECT MIN(mrp) FROM inventories WHERE product_id = products.id)');
                })
                ->select('products.*', 'inventories.mrp', 'inventories.offer_rate', 'inventories.purchase_rate', 'inventories.sku')
                ->get();

            $slug = $categorySlugs[$categoryId];

            $randomProductsByCategory[$slug] = $products->map(function ($product) {
                $firstAttributeValueSlug = optional($product->ProductAttributesValues->first()?->attributeValue)->slug;
                $firstImage = optional($product->images->first())->image_path;
                return [
                    'product_name' => $product->title,
                    'product_slug' => $product->slug,
                    'product_image' => $firstImage ?? null,
                    'mrp' => $product->mrp,
                    'offer_rate' => $product->offer_rate,
                    'sku' => $product->sku,
                    'first_attribute_value_slug' => $firstAttributeValueSlug,
                ];
            })->values();
        }
        //dd($randomProductsByCategory);
        $view->with([
            'categoriesWithMappedAttributesAndValues' => collect($formattedCategories),
            'randomProductsByCategory' => $randomProductsByCategory
        ]);

        Log::info("MenuComposer load time: " . (microtime(true) - $startTime));
    }
}

