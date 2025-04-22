<div class="row">
    <div class="col-xl-3">
        <div class="canvas-sidebar sidebar-filter canvas-filter left">
            <div class="canvas-wrapper">
                <div class="canvas-header d-flex d-xl-none">
                    <span class="title">Filter</span>
                    <span class="icon-close icon-close-popup close-filter"></span>
                </div>
                <div class="canvas-body">
                    @if (isset($attributes_with_values_for_filter_list) && $attributes_with_values_for_filter_list->isNotEmpty())
                    @if($attributes_with_values_for_filter_list->isNotEmpty())
                    @foreach($attributes_with_values_for_filter_list as $attributes)
                    <div class="widget-facet">
                        <div class="facet-title text-xl fw-medium" data-bs-target="#availability-{{ $attributes->id}}"
                            role="button" data-bs-toggle="collapse" aria-expanded="true"
                            aria-controls="availability-{{ $attributes->id}}">
                            <span>{{ $attributes->title}}</span>
                            <span class="icon icon-arrow-up"></span>
                        </div>
                        <div id="availability-{{ $attributes->id}}" class="collapse">
                            <ul class="collapse-body filter-group-check current-scrollbar">
                                @if ($attributes->AttributesValues->isNotEmpty())
                                @foreach ($attributes->AttributesValues as $value)
                                @if($value->name!=='NA')
                                <li class="list-item">
                                    <input type="checkbox"
                                        class="tf-check filter-checkbox"
                                        data-attribute-id="{{ $attributes->id }}"
                                        data-value-id="{{ $value->id }}"
                                        data-attslug="{{ $attributes->slug }}"
                                        data-attvslug="{{ $value->slug }}"
                                        value="{{ $value->name }}" id="check_{{ $value->id }}"
                                        @if(in_array($value->slug, explode(',', request()->query($attributes->slug, '')))) checked @endif
                                    >
                                    <label for="inStock" class="label">
                                        <span>
                                            {{ $value->name ?? 'Unnamed Value' }}
                                        </span>
                                        <!-- &nbsp;<span
                                                    class="count">(20)</span> -->
                                    </label>
                                </li>
                                @endif
                                @endforeach
                                @endif

                            </ul>
                        </div>
                    </div>
                    @endforeach
                    @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-9">
        <div class="tf-shop-control product-catelog-filter">
            <!-- <div class="row"> -->
            @php
            $selectedFilters = [];
            $queryParams = request()->query();
            foreach ($queryParams as $attributeSlug => $valueSlugs) {
            $selectedFilters[$attributeSlug] = explode(',', $valueSlugs);
            }
            @endphp

            <div class="filter-section">
                @if (!empty($selectedFilters))
                <div class="meta-filter-shop">
                    <div id="applied-filters">
                        @foreach ($selectedFilters as $attributeSlug => $valueSlugs)
                        @foreach ($valueSlugs as $valueSlug)
                        <span class="filter-tag remove-filter" data-att-slug="{{ $attributeSlug }}" data-value-slug="{{ $valueSlug }}">
                            <span class="icon-close"></span>
                            {{ ucfirst(strtolower((str_replace('-', ' ', $valueSlug)))) }}
                        </span>
                        </li>
                        @endforeach
                        @endforeach
                    </div>
                    <button id="clear-filters" class="remove-all-filters">
                        <i class="icon icon-close"></i>
                        Clear all filter
                    </button>
                </div>
                @endif
            </div>
            @php
            $currentSort = request()->query('sort', 'new-arrivals');
            @endphp

            <div class="dropdown-filter">
                <div class="tf-group-filter">
                    <button id="filterShop" class="tf-btn-filter d-flex d-xl-none">
                        <span class="icon icon-filter"></span><span class="text">Filter</span>
                    </button>
                    <div class="tf-dropdown-sort" data-bs-toggle="dropdown">
                        <div class="btn-select">
                            <span class="text-sort-value">
                                @switch($currentSort)
                                @case('price-low-to-high') Price Low To High @break
                                @case('price-high-to-low') Price High To Low @break
                                @case('a-to-z-order') A - Z Order @break
                                @default New Arrivals
                                @endswitch
                            </span>
                            <span class="icon icon-arr-down"></span>
                        </div>
                        <div class="dropdown-menu">
                            <div class="select-item {{ $currentSort == 'new-arrivals' ? 'active' : '' }}" data-sortid="new-arrivals">
                                <span class="text-value-item">New Arrivals</span>
                            </div>
                            <div class="select-item {{ $currentSort == 'price-low-to-high' ? 'active' : '' }}" data-sortid="price-low-to-high">
                                <span class="text-value-item">Price Low To High</span>
                            </div>
                            <div class="select-item {{ $currentSort == 'price-high-to-low' ? 'active' : '' }}" data-sortid="price-high-to-low">
                                <span class="text-value-item">Price High To Low</span>
                            </div>
                            <div class="select-item {{ $currentSort == 'a-to-z-order' ? 'active' : '' }}" data-sortid="a-to-z-order">
                                <span class="text-value-item">A - Z Order</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- </div> -->
        </div>
        <div class="wrapper-control-shop">
            <div class="wrapper-shop tf-grid-layout tf-col-4 product-list-section" id="load-more-append">
                @include('frontend.pages.partials.product-catalog-load-more', [$products])
            </div>
            @if ($products->hasMorePages())
            <div
                class="show-more-products d-flex justify-content-center">
                <button id="load-more" class="tf-btn btn-out-line-dark2 tf-loading loadmore mt-3" data-next-page="{{ $products->currentPage() + 1 }}" data-last-page="{{ $products->lastPage() }}">
                    Load More
                </button>
            </div>
            @endif
        </div>
    </div>
</div>