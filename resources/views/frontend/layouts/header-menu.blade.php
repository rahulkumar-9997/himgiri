<header id="header" class="header-default">
   <div class="container">
      <div class="row wrapper-header align-items-center">
         <div class="col-md-4 col-3 d-xl-none">
            <a href="#mobileMenu" class="mobile-menu" data-bs-toggle="offcanvas" aria-controls="mobileMenu">
               <i class="icon icon-categories1"></i>
            </a>
         </div>
         <div class="col-xl-2 col-md-4 col-6">
            <a href="{{ url('/') }}" class="logo-header">
               <img src="{{asset('frontend/assets/himgiri-img/logo/1.png')}}" alt="logo" class="logo">
            </a>
         </div>
         <div class="col-xl-8 d-none d-xl-block">
            <nav class="box-navigation text-center">
               <ul class="box-nav-menu">
                  <li class="menu-item">
                     <a href="{{route('about-us')}}" class="item-link">About Us</a>
                  </li>
                  @if(isset($categoriesWithMappedAttributesAndValues))
                  @foreach($categoriesWithMappedAttributesAndValues as $category)
                  <li class="menu-item">
                     <a href="#" class="item-link">
                        {{ $category['title'] }}
                        <i class="icon icon-arr-down"></i>
                     </a>
                     <div class="sub-menu mega-menu mega-shop">
                        <div class="wrapper-sub-menu">
                           @if(!empty($category['attributes']))
                           @foreach($category['attributes'] as $attribute)
                           <div class="mega-menu-item">
                              <div class="menu-heading">{{ $attribute['title'] }}</div>
                              <ul class="menu-list">
                                 @foreach($attribute['values'] as $value)
                                 <li>
                                    <a
                                       href="{{ route('collections', [
                                            'category_slug' => $category['category-slug'],
                                            'attributes_value_slug' => $value['slug']
                                             ]) }}"
                                       class="menu-link-text link">
                                       {{ $value['name'] }}
                                    </a>
                                 </li>
                                 @endforeach
                              </ul>
                           </div>
                           @endforeach
                           @endif

                        </div>

                        <div class="wrapper-sub-collection">
                           @if(isset($randomProductsByCategory) && count($randomProductsByCategory))
                           <div dir="ltr" class="swiper tf-swiper hover-sw-nav wow fadeInUp"
                              data-swiper='{
                                    "slidesPerView": 2,
                                    "spaceBetween": 24,
                                    "speed": 800,
                                    "observer": true,
                                    "observeParents": true,
                                    "slidesPerGroup": 2,
                                    "navigation": {
                                          "clickable": true,
                                          "nextEl": ".nav-next-cls-header",
                                          "prevEl": ".nav-prev-cls-header"
                                    },
                                    "pagination": { "el": ".sw-pagination-cls-header", "clickable": true }
                                 }'>
                              <div class="swiper-wrapper">
                                 @foreach($randomProductsByCategory as $categorySlug => $products)
                                    @foreach($products as $product)
                                       @php
                                       $imagePath = !empty($product['product_image']) && file_exists(public_path('images/product/thumb/' . $product['product_image']))
                                       ? asset('images/product/thumb/' . $product['product_image'])
                                       : asset('frontend/assets/himgiri-img/logo/1.png');
                                       @endphp

                                       <div class="swiper-slide">
                                          <div class="wg-cls style-abs asp-1 hover-img">
                                             <a href="{{ route('products', [
                                                   'product_slug' => $product['product_slug'],
                                                   'attributes_value_slug' => $product['first_attribute_value_slug']
                                                ]) }}" class="image img-style d-block">
                                                <img src="{{ $imagePath }}" alt="{{ $product['product_name'] }}" class="lazyload" />
                                             </a>
                                             <div class="card-product-info text-center">
                                                <a 
                                                href="{{ route('products', [
                                                   'product_slug' => $product['product_slug'],
                                                   'attributes_value_slug' => $product['first_attribute_value_slug']
                                                ]) }}"
                                                class="name-product link fw-medium text-md">
                                                   {{ $product['product_name'] }}
                                                </a>
                                                <!--<p class="price-wrap fw-medium">
                                                   <span class="price-new text-primary">Rs. 100.00</span>
                                                   <span class="price-old">Rs. 130.00</span>
                                                </p>-->
                                             </div>
                                          </div>
                                       </div>
                                    @endforeach
                                 @endforeach
                              </div>

                              <div class="d-flex d-xl-none sw-dot-default sw-pagination-cls-header justify-content-center"></div>
                              <div class="d-none d-xl-flex swiper-button-next nav-swiper nav-next-cls-header"></div>
                              <div class="d-none d-xl-flex swiper-button-prev nav-swiper nav-prev-cls-header"></div>
                           </div>
                           @endif


                        </div>
                     </div>
                  </li>
                  @endforeach
                  @endif


                  <li class="menu-item">
                     <a href="{{ route('blog') }}" class="item-link">Blog</a>
                  </li>
                  <li class="menu-item">
                     <a href="{{ route('contact-us') }}" class="item-link">Contact Us</a>
                  </li>
               </ul>
            </nav>
         </div>
         <div class="col-xl-2 col-md-4 col-3">
            <ul class="nav-icon d-flex justify-content-end align-items-center">
               <li class="nav-search">
                  <a href="javascript:void(0);" data-route="{{ route('search-modal-open') }}" data-bs-toggle="modal" class="nav-icon-item search-modal-open">
                     <i class="icon icon-search"></i>
                  </a>
               </li>
            </ul>
         </div>
      </div>
   </div>
</header>