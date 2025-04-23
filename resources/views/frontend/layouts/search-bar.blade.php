@php
$query = request()->get('query');
$search_value = !empty($query) ? $query : '';
@endphp
<!-- search product -->
<div class="modal fade popup-search type-search-product search-modal" id="search">
    <div class="modal-dialog modal-fullscreen search-body start-animation">
        <div class="modal-content">
            <div class="modal-body">
                <div class="header">
                    <button class="icon-close icon-close-popup" data-bs-dismiss="modal"></button>
                </div>
                <div class="container-3">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="looking-for-wrap">
                                <div class="heading">What are you looking for ?</div>
                                <form class="form-search" id="search-form"  action="{{route('search')}}" method="get" autocomplete="off">
                                    <div class="search-form_vall">
                                        <fieldset class="text">
                                            <input type="text" id="search-input" placeholder="Search" class="" name="query" tabindex="0"
                                            value="{{$search_value}}" aria-required="true" required="">
                                        </fieldset>
                                        <button class="" type="submit">
                                            <i class="icon icon-search"></i>
                                        </button>
                                    </div>
                                    <ul class="suggestions-list suggestions"></ul>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="search-modal-render-data">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script>
   let searchSuggestionUrl = "{{ route('search.suggestions') }}";
</script>
<!-- /search product -->