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
                <span><a href="product/#= id#"><h3>#:name#</h3></a></span>
            </div>
            <div class="addToCompare">
                <button class="btn add-to-compare-btn">
                    <img src="/css/Default/compare.png" />

                </button>
            </div>
            <div class="addToCart">
                    #if(amount > 0){#
                        <button class="btn add-to-cart-btn" >
                    #}else{#
                            <button class="btn add-to-cart-btn" disabled="disabled">
                    #}#
                        <img src="/css/Default/cart.png" />
                        <span>Купить</span>
                    </button>
            </div>
            <div class="price">
                <span>#:price# руб</span></spa>
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
                        <span>#: reviews#</span>
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
