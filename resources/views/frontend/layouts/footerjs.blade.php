<script src="{{asset('frontend/assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/jquery.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/swiper-bundle.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/carousel.js')}}"></script>
<script src="{{asset('frontend/assets/js/bootstrap-select.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/lazysize.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/count-down.js')}}"></script>
<script src="{{asset('frontend/assets/js/wow.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/multiple-modal.js')}}"></script>
<script src="{{asset('frontend/assets/js/infinityslide.js')}}"></script>
<script src="{{asset('frontend/assets/js/main.js')}}"></script>
<script src="{{asset('frontend/assets/js/pages/search.js')}}"></script>
<script src="{{asset('frontend/assets/js/common.js')}}"></script>
@if (session('error'))
    <script>
        $(document).ready(function () {
            showToast('danger', {!! json_encode(session('error')) !!});
        });
    </script>
@endif

@if (session('success'))
    <script>
        $(document).ready(function () {
            showToast('success', {!! json_encode(session('success')) !!});
        });
    </script>
@endif
