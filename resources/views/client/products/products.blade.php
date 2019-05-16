@extends('client.layouts.clientLayout')

@section('breadcrumbs')
<div>
    {{Breadcrumbs::render('products', $type)}}
</div>
@endsection

@section('content')
<div>
    <input id="productFilter" hidden value="{{$filter}}">
    <div class="product-search">
        <input type="text" id="productSearch"class="input-group-lg" placeholder="Найти...">
    </div>
    <div class="productList" id="productList"></div>
    <div id="productsPager"></div>
</div>
@endsection

@section('scripts')
    <script src="/js/common-settings.js"></script>
    <script type="text/x-kendo-template" id="productListTemplate">

        <div class="product">
            <input type="hidden" class="product-id-hidden" value="#= id#">

            <div class="photo">
                <a class="" href="product/#= id#">
                    #if(productImage){#
                    <img src="/storage#= productImage #" alt="#: name #" width="100" height="100"/>
                    #}else{#
                    <img src="/css/Default/image-not-available.jpg" alt="Фото отсутствует"/>
                    #}#
                </a>
            </div>

            <div class="title">
                <span><a href="product/#= id#"><h4>#:name#</h4></a></span>
            </div>

            <div class="addToCart">
                    #if(amount > 0){#
                        <button class="btn add-to-cart-btn addCart">
                    #}else{#
                            <button class="btn add-to-cart-btn" disabled="disabled">
                    #}#
                        <img src="/css/Default/cart.png"/>
                        <span><i class="fas fa-shopping-cart" style="margin-right: 10px"></i>Купить</span>
                    </button>
            </div>

            <div class="price">
                <span><h4>#:price# руб</h4></span>
            </div>

            <div class="amount">
                <span>
                    В наличии:
                    #if(amount > 0){#
                        #: amount # шт.
                    #}else{#
                        нет
                    #}#
                </span>
            </div>

            <div class="reviews">
                #if(reviews && reviews > 0){#
                <div>
                    <a href="\\#">
                        <img src="/css/Default/reviews.png"/>
                        <span style="color: #cacaca">#: reviews#</span>
                    </a>
                </div>
                #}#
            </div>
        </div>
    </script>

    <script>
        $(function () {
           var dataSource = new kendo.data.DataSource({
              transport: {
                  read:{
                      url:'/products/getAllProducts',
                      dataType: 'json',
                      data: {
                          filter: JSON.parse($("#productFilter").val())
                      }
                  }
              },
              schema: {
                  type: 'json',
                  data: 'products',
                  total: 'total'
              },
              serverPaging:true,
              pageSize:5,

           });
            $("#productsPager").kendoPager({
                dataSource: dataSource
            });

            $("#productList").kendoListView({
                dataSource: dataSource,
                pageable: true,
                template: kendo.template($("#productListTemplate").html())
            });
            $("#productSearch").bind("enterSearchValue", function () {
                var name = $("#productSearch").val();
                var listView = $("#productList").data('kendoListView');
                var data = listView.dataSource.options.transport.read.data;
                if(data.filter){
                    var filter = data.filter;
                    filter.productName = name;
                    filter.subCategory = null;
                    filter.orderByPrice = null;
                    listView.dataSource.options.transport.read.data.filter = filter;
                    listView.dataSource.read();
                }
            });
            $("#productSearch").keyup(function (e) {
               if(e.keyCode == 13){
                   $(this).trigger("enterSearchValue");
               }
            });
            $(document).on('click', ".add-to-cart-btn", function () {
               var product = $(this).closest('.product');
               var productId = product.children('.product-id-hidden').val();
               if(productId){
                    $.post(
                        '/shoppingCart/addToCart',
                        {prodId: productId},
                        function (response) {
                            response = JSON.parse(response)[0];
                            if(response.success){
                                if(response.data.productsCount) {
                                    $('.cart-product-count').text(response.data.productsCount);
                                }
                            }
                        }
                    )
               }
            });
            $(document).on('click', ".add-to-compare-btn", function () {
               var product = $(this).closest('.product');
               var productId = product.children('.product-id-hidden').val();
               if(productId){
                    $.post(
                        '/addToCompare',
                        {prodId: productId},
                        function (response) {
                            response = JSON.parse(response)[0];
                            if(response.success){
                                if(response.data.comparedCount) {
                                    $('.compare-product-count').text(response.data.comparedCount);
                                }
                            }
                        }
                    )
               }
            });

        });
    </script>

@endsection













{{--@extends('client.layouts.clientLayout')--}}


{{--@section('content')--}}


    {{--<div class="productBlock k-widget k-listview" id="productBlock" >--}}
        {{--<div class="product">--}}
            {{--<input id="prodId" hidden value='{{ $product->getId() }}'/>--}}
            {{--<h1>{{ $product->getName() }}</h1>--}}
            {{--<div class="photo inline">--}}
                {{--@if  ( $product->getPhotos()->isEmpty() )--}}
                    {{--<img src="/css/Default/image-not-available.jpg" alt="Фото отсутствует"/>--}}
                {{--@else--}}
                    {{--<img src="/storage{{ $product->getPhotos()->first()->getImage() }}" alt="Фото"/>--}}
                {{--@endif--}}
            {{--</div>--}}
            {{--<div class='summary inline'>--}}
                {{--<p class='price'>{{ $product->getPrice() }} P.</p>--}}
                {{--<p class='prod'>Производитель: {{ $product->getProducer() }}</p>--}}
                {{--<p class='desc'>{{ $product->getDescription() }}</p>--}}
                {{--<div>--}}
                    {{--<div class="addToCompareBlock">--}}
                        {{--@if($isInCompare)--}}
                            {{--<button class="btn btn-default"><a href="/compare">В сравнении</a></button>--}}
                        {{--@elseif(!($compareAllowed))--}}
                            {{--<button id='not-allowed' class="btn btn-default">Невозможно добавить</button>--}}
                            {{--<div id='not-allowed-notice' class='not-allowed-notice' style="display: none;"> очистите свой список сравнения </div>--}}
                        {{--@else--}}
                            {{--<button class="btn" id="compareBtn" >--}}
                                {{--<img src="/css/Default/compare.png" />--}}
                            {{--</button>--}}
                        {{--@endif--}}
                    {{--</div>--}}

                    {{--<div class="addToCart">--}}
                        {{--@if($product->getAmount() > 0)--}}
                            {{--@if($isInCart)--}}
                                {{--<button class="btn btn-default"><a href="/shoppingCart">В корзине</a></button>--}}
                            {{--@else--}}
                                {{--<button class="btn" id="addToCartBtn">--}}
                                    {{--<img src="/css/Default/cart.png" />--}}
                                    {{--<span>Купить</span>--}}
                                {{--</button>--}}
                            {{--@endif--}}
                        {{--@else--}}
                            {{--<span><h4>Нет в наличии</h4></span>--}}
                        {{--@endif--}}
                    {{--</div>--}}

                {{--</div>--}}
            {{--</div>--}}
            {{--<div class='info'>--}}
                {{--<div class="tab">--}}
                    {{--<button class="tablinks" onclick="openTab(event, 'Features')" id="defaultOpen"> <h4>Характеристики</h4></button>--}}
                    {{--<button class="tablinks" onclick="openTab(event, 'Reviews')"><h4>Отзывы</h4></button>--}}
                {{--</div>--}}

                {{--<div id="Features" class="tabcontent">--}}
                    {{--<h3>Характеристики</h3>--}}

                    {{--<table>--}}
                        {{--<tbody>--}}
                        {{--@foreach ($features as $feature)--}}
                            {{--<tr>--}}
                                {{--<td> {{$feature->getName()}} </td>--}}
                                {{--<td> @php--}}
                                        {{--$value = "N/A";--}}
                                        {{--$feature_p = $product->getFeatures()->filter(--}}
                                        {{--function($item) use($feature) {return $item->getFeature()->getId() === $feature->getId();});--}}
                                        {{--if (!$feature_p->isEmpty()) $value = $feature_p->first()->getValue()--}}
                                    {{--@endphp--}}
                                    {{--{{ $value }}--}}
                                {{--</td>--}}
                            {{--</tr>--}}
                        {{--@endforeach--}}
                        {{--</tbody>--}}
                    {{--</table>--}}

                {{--</div>--}}

                {{--<div id="Reviews" class="tabcontent">--}}
                    {{--<h3>Отзывы</h3>--}}
                    {{--<p></p>--}}
                {{--</div>--}}

            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}



{{--@endsection--}}


{{--@section('scripts')--}}

    {{--<script src="/js/common-settings.js"></script>--}}
    {{--<script>--}}
        {{--document.getElementById("defaultOpen").click();--}}

        {{--function openTab(evt, Name) {--}}
            {{--// Declare all variables--}}
            {{--var i, tabcontent, tablinks;--}}

            {{--// Get all elements with class="tabcontent" and hide them--}}
            {{--tabcontent = document.getElementsByClassName("tabcontent");--}}
            {{--for (i = 0; i < tabcontent.length; i++) {--}}
                {{--tabcontent[i].style.display = "none";--}}
            {{--}--}}

            {{--// Get all elements with class="tablinks" and remove the class "active"--}}
            {{--tablinks = document.getElementsByClassName("tablinks");--}}
            {{--for (i = 0; i < tablinks.length; i++) {--}}
                {{--tablinks[i].className = tablinks[i].className.replace(" active", "");--}}
            {{--}--}}

            {{--// Show the current tab, and add an "active" class to the button that opened the tab--}}
            {{--document.getElementById(Name).style.display = "block";--}}
            {{--evt.currentTarget.className += " active";--}}
        {{--}--}}
    {{--</script>--}}


    {{--<script>--}}
        {{--$(function(){--}}
            {{--$("#addToCartBtn").click(function () {--}}
                {{--$.post('/shoppingCart/addToCart', {prodId: $("#prodId").val()}, function (response) {--}}
                    {{--response = JSON.parse(response)[0];--}}
                    {{--if(response.success){--}}
                        {{--if(response.data.productsCount) {--}}
                            {{--$('.cart-product-count').text(response.data.productsCount);--}}
                        {{--}--}}
                    {{--}--}}
                {{--})--}}
            {{--});--}}
        {{--});--}}

        {{--$(function() {--}}
            {{--$("#compareBtn").click(function() {--}}
                {{--$.post('/addToCompare', { prodId:$("#prodId").val() },--}}
                    {{--function(response){--}}
                        {{--response = JSON.parse(response)[0];--}}
                        {{--if (response.success) {--}}
                            {{--if(response.data.comparedCount) {--}}
                                {{--$(".compare-product-count").text(response.data.comparedCount);--}}
                            {{--}--}}
                        {{--}--}}
                    {{--});--}}
            {{--});--}}

            {{--$('#not-allowed').hover(function() {--}}
                {{--$('#not-allowed-notice').show();--}}
            {{--}, function() {--}}
                {{--$('#not-allowed-notice').hide();--}}
            {{--});--}}
        {{--});--}}

    {{--</script>--}}
{{--@endsection--}}
































