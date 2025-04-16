<?php
namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use App\Models\Category;

class MenuComposer
{
    public function compose(View $view)
    {
        //Log::info("MenuComposer is being executed");
        Log::info("MenuComposer triggered by view: ".$view->getName());
        // Log::info("MenuComposer triggered by view: frontend.layouts.header-menu", [
        //     'trace' => collect(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 10))
        //         ->pluck('file')
        //         ->filter()
        //         ->toArray()
        // ]);
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
        //Log::info('Menu, mega menu Total Loading Time menuComposer (seconds): ' . $loadingTime);

        $view->with('categoriesWithMappedAttributesAndValues', $formattedCategories);
    }
}

