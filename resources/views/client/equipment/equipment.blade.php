@extends('client.layouts.clientLayout')
@section('breadcrumbs')
{{Breadcrumbs::render('equipment')}}
@endsection
@section('content')
    <div>
        <div class="text-center">
            <h2>{{$equipmentName}} для комлектации</h2>
        </div>
        <input id="equipmentStage" hidden value="{{$equipmentStage}}">
        <div class="productList" id="productList" style="display: none"></div>
        <div id="productsPager" style="display: none"></div>
        <div id="errorInfo" style="display: none" class="text-center">
            <h2>Для данной подкатегории отсутствуют товары по совместимости с товарами, ранее выбранными.</h2>
            <button class="btn btn-default"><a href="/equipment/reset">Вернуться на начальную стадию</a></button>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="/js/common-settings.js"></script>
    <script type="text/x-kendo-template" id="productListTemplate">
        #if(amount > 0){#
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

                <button class="btn add-to-cart-btn" >
                        <span>Выбрать</span>
                </button>
            </div>
            <div class="price">
                <span>#:price# руб</span></spa>
            </div>
            <div class="amount">
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
        #}#
    </script>
    <script>
        $(function () {
            var dataSource = new kendo.data.DataSource({
                transport: {
                    read:{
                        url:'/equipment/getProductsByEquipmentStage',
                        dataType: 'json',
                        data: {
                            equipmentStage: $("#equipmentStage").val()
                        },
                        complete: function (response) {

                            response = response.responseJSON;
                            if (response) {
                                if (response.total != null && response.total == 0) {

                                    $("#productList").hide();
                                    $("#productsPager").hide();
                                    $("#errorInfo").show();
                                }
                                else {
                                    $("#productList").show();
                                    $("#productsPager").show();
                                    $("#errorInfo").hide();
                                }
                            }
                        },

                    }
                },
                schema: {
                    type: 'json',
                    data: 'products',
                    total: 'total'
                },
                serverPaging:true,
                pageSize:5

            });
            $("#productsPager").kendoPager({
                dataSource: dataSource
            });

            $("#productList").kendoListView({
                dataSource: dataSource,
                pageable: true,
                template: kendo.template($("#productListTemplate").html())
            });
            $(document).on('click', ".add-to-cart-btn", function () {
                var product = $(this).closest('.product');
                var productId = product.children('.product-id-hidden').val();
                if(productId){
                    $.post(
                        '/equipment/addToEquipment',
                        {prodId: productId, currentStage: $("#equipmentStage").val()},
                        function (response) {
                            response = JSON.parse(response)[0];
                            if(response.success){
                                window.location = '/equipment';
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