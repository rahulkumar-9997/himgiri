<!-- mobile menu -->
<div class="offcanvas offcanvas-start canvas-mb" id="mobileMenu">
    <div class="mobile-menu-log">
        <a href="{{ url('/') }}" class="logo-header-mobile">
            <img src="{{asset('frontend/assets/himgiri-img/logo/1.png')}}" alt="logo" class="logo">
        </a>
        <button class="icon-close icon-close-popup" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="mb-canvas-content">
        <div class="mb-body">
            <div class="mb-content-top">
                <ul class="nav-ul-mb" id="wrapper-menu-navigation">
                    <li class="nav-mb-item">
                        <a href="{{ route('about-us')}}" class="mb-menu-link">About Us</a>
                    </li>
                    @if(isset($categoriesWithMappedAttributesAndValues))
                    @foreach($categoriesWithMappedAttributesAndValues as $category)
                    <li class="nav-mb-item">
                        @php
                        $categoryCollapseId = 'dropdown-menu-shop-' . $loop->index;
                        @endphp
                        <a href="#{{ $categoryCollapseId }}" class="collapsed mb-menu-link" data-bs-toggle="collapse"
                            aria-expanded="false" aria-controls="{{ $categoryCollapseId }}">
                            <span>{{ $category['title'] }}</span>
                            <span class="btn-open-sub"></span>
                        </a>
                        @if(!empty($category['attributes']))
                        <div id="{{ $categoryCollapseId }}" class="collapse">
                            
                            <ul class="sub-nav-menu">
                                <li class="nav-mb-item">
                                    <a href="{{ route('categories', [
                                        'category_slug' => $category['category-slug']
                                        ]) }}" class="mb-menu-link">
                                        All {{ $category['title'] }}
                                    </a>
                                </li>
                                @foreach($category['attributes'] as $attribute)
                                @php
                                $attributeCollapseId = 'sub-shop-layout-' . $loop->parent->index . '-' . $loop->index;
                                @endphp
                                <li>
                                    <a href="#{{ $attributeCollapseId }}" class="sub-nav-link collapsed"
                                        data-bs-toggle="collapse" aria-expanded="false"
                                        aria-controls="{{ $attributeCollapseId }}">
                                        <span>{{ $attribute['title'] }}</span>
                                        <span class="btn-open-sub"></span>
                                    </a>
                                    <div id="{{ $attributeCollapseId }}" class="collapse">
                                        <ul class="sub-nav-menu sub-menu-level-2">
                                            @foreach($attribute['values'] as $value)
                                            <li>
                                                <a href="{{ route('collections', [
                                                    'category_slug' => $category['category-slug'],
                                                    'attributes_value_slug' => $value['slug']
                                                ]) }}" class="sub-nav-link">
                                                    {{ $value['name'] }}
                                                </a>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </li>
                    @endforeach
                    @endif

                    <li class="nav-mb-item">
                        <a href="{{ route('blog')}}" class="mb-menu-link">Blog</a>
                    </li>
                    <li class="nav-mb-item">
                        <a href="{{ route('contact-us')}}" class="mb-menu-link">Contact Us</a>
                    </li>
                </ul>
            </div>
            <div class="mb-other-content">
                <!-- <div class="group-icon">
                    <a href="#" class="site-nav-icon">
                        <i class="icon icon-heart"></i>
                        Wishlist
                    </a>
                    <a href="#login" data-bs-toggle="offcanvas" class="site-nav-icon">
                        <i class="icon icon-user"></i>
                        Login
                    </a>
                </div> -->
                <div class="mb-notice">
                    <a href="{{ route('contact-us')}}" class="text-need">Address </a>
                </div>
                <div class="mb-contact">
                    <p>Industrial Estate, D 5 & 6, Munshi Pura, Mau, Uttar Pradesh 275101</p>
                </div>
                <ul class="mb-info">
                    <li>
                        Email:
                        <b class="fw-medium">
                            <a href="mailto:info@himgiricoolers.com">info@himgiricooler.com</a>
                        </b>
                    </li>
                    <!-- <li>
                        Phone:
                        <b class="fw-medium">+91 8048740318</b>
                    </li> -->
                </ul>
            </div>
        </div>

    </div>
</div>
<!-- /mobile menu -->