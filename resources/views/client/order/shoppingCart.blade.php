@extends('client.layouts.clientLayout')
@section('breadcrumbs')
    {{Breadcrumbs::render('shoppingCart')}}
@endsection
@section('content')
<div class="shopping-cart-products">
        <div class="productBlock k-widget k-listview" id="productBlock" >
            <div id="emptyProductCart" style={{empty($products)?"":"display:none"}}>
                <p>Вы не выбрали ни одного товара. Для добавления товаров перейдите в <a href="/catalog">каталог</a></p>
            </div>
        </div>
        <div id="productCart">
            @if(!empty($products))
                <div class="shopping-result">
                    <div class="result-sum">
                        <input type="hidden" id="hiddenResultSum" value="{{$resultSum}}">
                        Итого : <span id="resultSum">{{$resultSum}}</span> руб
                    </div>

                    <div>
                        <button class="btn btn-default" id="checkout" style="width: 100%">Оформить заказ</button>
                    </div>
                </div>
                <div class="productList" id="shoppingProductList" style={{empty($products)?"display:none":""}}>
                    @foreach($products as $product)
                        <div class="product">
                            <input type="hidden" class="hiddenProductId" value="{{$product->getId()}}" >
                            <div class="photo">
                                <a class="" href="/product/{{$product->getId()}}">
                                    @if(!$product->getPhotos()->isEmpty())
                                        <img src="/storage{{$product->getPhotos()->first()->getImage()}}" alt="{{$product->getName()}}" width="100" height="100"/>
                                    @else
                                        <img src="/css/Default/image-not-available.jpg" alt="фото не найдено" />
                                    @endif
                                </a>
                            </div>
                            <div class="title">
                                <span><a href="/product/{{$product->getId()}}"><h3>{{$product->getName()}}</h3></a></span>
                            </div>
                            <div class="product-amount">
                                <input class="product-amount-input" id="productAmountInput{{$product->getId()}}" value="1" max="{{$product->getAmount()}}" style="width: 7%">
                            </div>
                            <div class="price">
                                <input type="hidden" class="product-price-hidden" value="{{$product->getPrice()}}"/>
                                <span>{{intval($product->getPrice())}}</span> руб.
                            </div>
                            <div class="delete-product">
                                <button class="btn btn-danger delete-product-btn">Убрать из корзины</button>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
</div>
@endsection
@section('scripts')
<script src="/js/common-settings.js"></script>
<script>
    $(function () {
        $('.product-amount-input').kendoNumericTextBox({
            format: '0',
            decimals: 0,
            min: 1,
            change: checkProductAmount
        });
        function checkProductAmount(e) {
            var currentProduct = $(e.sender.element[0]);
            var currentProductId = currentProduct.closest('.product').children('.hiddenProductId').val();
            var currentProductAmount = currentProduct.val();
            var checkData = {
                currentProductId: currentProductId,
                currentProductAmount: currentProductAmount
            };
            $.post('/shoppingCart/checkAndUpdateProductInfo', checkData, function (response) {
                response = JSON.parse(response)[0];
                if(response.success){
                    currentProduct.closest('.product').children('.price').children('span').text(response.data.productPrice);
                    currentProduct.closest('.product').children('.price').children('.product-price-hidden').val(response.data.productPrice);
                    recalculateResultSum();
                }
                else{
                    bootbox.alert(response.message);
                }
            });
        }

        function recalculateResultSum(){
            var resultSum = 0;
            var currentSum = 0;
            var products = $(".productList").children('.product');
            products.each(function (i, product) {
                currentSum = parseInt($(product).children('.price').children('.product-price-hidden').val());
                resultSum += currentSum;
            });
            $("#resultSum").text(resultSum);
            $("#hiddenResultSum").val(resultSum);
        }

        $(".delete-product-btn").click(function (e) {
            var product = $(this).closest('.product');
            var productId = product.children('.hiddenProductId').val();
            $.post(
                '/shoppingCart/deleteProduct',
                {productId: productId},
                function (response) {
                    response = JSON.parse(response)[0];
                    if(response.success){
                        product.remove();
                        recalculateResultSum();
                        $('.cart-product-count').text(response.data.productsCount);
                        if(response.data.productsCount == 0){
                            $("#productCart").hide();
                            $("#emptyProductCart").show();
                        }
                    }
                }
            );
        });

        $('#checkout').click(function (e) {
            var order = {products: [], orderPrice: null};
            var products = $(".productList").children('.product');
            products.each(function (i, product) {
                var productId = $(product).children('.hiddenProductId').val();
                var productAmount = parseInt($("#productAmountInput"+productId).val());
                order.products.push({productId: productId, productAmount: productAmount});
            });
            order.orderPrice = $("#hiddenResultSum").val();
            if(order.products.length > 0){
                $.post(
                    '/shoppingCart/checkout',
                    {order: JSON.stringify(order)},
                    function (response) {
                        response = JSON.parse(response)[0];
                            if(response.success){
                            window.location.replace("/order");
                        }
                        else{
                            bootbox.alert(response.message)
                        }
                });
            }
        });
    });
</script>
@endsection
