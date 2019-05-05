@extends('client.layouts.clientLayout')
@section('breadcrumbs')
    {{Breadcrumbs::render('equipment')}}
@endsection
@section('content')
    <div class="shopping-cart-products">
        <div class="text-center">
            <h2>Оформление комплектации</h2>
        </div>
        <div class="productBlock k-widget k-listview" id="productBlock" >
            <div id="emptyProductCart" style={{empty($products)?"":"display:none"}}>
                <p>Вы не выбрали ни одного товара. Для добавления товаров перейдите в <a href="/catalog">каталог</a></p>
            </div>
        </div>

        <div id="productCart" >
            @if(!empty($products))
                <div class="shopping-result">
                    <div class="result-sum">
                        <input type="hidden" id="hiddenResultSum" value="{{$resultSum}}">
                        Итого : <span id="resultSum">{{$resultSum}}</span> руб
                    </div>
                    <div class="text-center">
                        <div class="form-group">
                            <span><h3>Ваш телефон</h3></span>
                            <div>
                                <input  name="phoneNumber" type='text' id="phoneNumber" class="form-control" style="width: 100%; height: inherit">
                            </div>
                        </div>
                        <div class="">
                            <div>
                                <span><h3>Выберите время получения заказа</h3></span>
                            </div>
                            <div class="form-inline">
                                <label for="chooseReceivingTime"><button id="chooseReceivingTime" type="button" href="#dialog"
                                                                         name="modal" class="btn btn-default">Выбрать</button></label>
                                <input name='receivingTime' id="chooseReceivingTime" class="form-control readonly" style="width: 100%">
                            </div>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-success" id="checkout" style="width: 100%">Оформить заказ</button>
                    </div>
                </div>
                @if(!empty($products))
                <div class="text-center" >
                    <button  id="showProducts" class="btn btn-default" style="width:100%;">Показать товары</button>
                </div>
                @endif
                <div class="productList" id="shoppingProductList" style="display:none">
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
                            <div class="price">
                                <input type="hidden" class="product-price-hidden" value="{{$product->getPrice()}}"/>
                                <span>{{intval($product->getPrice())}}</span> руб.
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    <input id="prodId" name="id_work_scheduler" type="hidden" value="">
    <div id="boxes">
        <div id="dialog" class="window">

            <span><a href="#" class="close">Закрыть</a>
    </span></div>
        <div id="back"></div>
    </div>
@endsection
@section('scripts')
    <script src="/js/common-settings.js"></script>
    <script>
        $(function () {
            $('#checkout').click(function (e) {
                var order = {products: [], orderPrice: null, phone: null};
                var products = $(".productList").children('.product');
                products.each(function (i, product) {
                    var productId = $(product).children('.hiddenProductId').val();
                    order.products.push({productId: productId, productAmount: 1});
                });
                order.orderPrice = $("#hiddenResultSum").val();
                order.phone = $("#phoneNumber").val();
                if(order.products.length > 0){
                    $.post(
                        '/equipment/checkout',
                        {order: JSON.stringify(order)},
                        function (response) {
                            response = JSON.parse(response)[0];
                            if(response.success){
                                window.location.replace("/thanksForPurchase");
                            }
                            else{
                                bootbox.alert(response.message)
                            }
                        });
                }
            });
            $("#showProducts").click(function () {
                $("#shoppingProductList").toggle();
            });
        });
    </script>
    <script>

        function checkInArr(arr, key) {
            const sp = key.split('-');
            const checkValue = sp[0] + '-' + sp[1];

            for (let i = 0; i < arr.length; i++) {
                const str = arr[i];
                if (str.indexOf(checkValue) !== -1) {
                    return true;
                }
            }
        }

        $(document).ready(function () {

            $(".readonly").on('keydown paste', function(e){
                e.preventDefault();
            });

            let selectTimeSlot = null;
            let lastSelectTimeSlot = '';

            $('button[name=modal]').click(function (e) {
                // e.preventDefault();
                $(this).attr('disabled',true);

                $.get('/workSchedules', {}, function (response) {
                    let arrTimes = [];
                    let arrDates = [];

                    let arrTableData = {};
                    for (let i = 0; i < response.length; i++) {
                        const element = response[i];
                        const timeSlot = JSON.parse(element.timeSlot);
                        const key = `${timeSlot.start}-${timeSlot.end}-${element.id}`;
                        if (!checkInArr(arrTimes, key)) {
                            arrTimes.push(key);
                        }
                        const sp = key.split('-');
                        const value = sp[0] + '-' + sp[1];
                        if (!arrTableData[element.date]) {
                            arrTableData[element.date] = {[value]: element};
                        }
                        arrTableData[element.date] = Object.assign(arrTableData[element.date], {[value]: element});

                        if (!arrDates.includes(element.date)) {
                            arrDates.push(element.date);
                        }
                    }


                    let table = '<table class="table"><thead> <tr><th>Дата</th>';
                    for (let i = 0; i < arrTimes.length; i++) {

                        const times = arrTimes[i].split('-');

                        table += '<th>' + times[0] + '-' + times[1] + '</th>'
                    }
                    table += '</tr></thead><tbody>';


                    Object.keys(arrTableData).forEach(date=>{
                        table += '<tr>';
                    table += '<td>' + date + '</td>';

                    const times = arrTableData[date];
                    Object.keys(times).forEach(time=>{
                        const timeObj = times[time];

                    if(timeObj.status !==1){
                        table += `<td class="bg-danger" name='timeSlot' id= "${date + '__' + time+'-'+timeObj.id}"> </td>`
                    }else{
                        table += `<td class="bg-success" name='timeSlot' id= "${date + '__' + time+'-'+timeObj.id}"> </td>`
                    }
                });

                    table += '</tr>';

                });

                    table += '</tbody> </table>';
                    $(".window").append(table);


                    $('td[class=bg-success]').click(function (e) {
                        

                        if (!selectTimeSlot) {
                            $(this).removeClass('bg-success').addClass('bg-danger');
                            let temeslotStr = $(this).attr('id').split('__')[1];
                            temeslotStr = temeslotStr.split('-');

                            lastSelectTimeSlot = temeslotStr[0] + '-' + temeslotStr[1];
                            $('input[name=id_work_scheduler]').attr('value', temeslotStr[2]);
                            $('input[name=receivingTime]').attr('value', lastSelectTimeSlot);
                            selectTimeSlot = $(this);
                        } else {
                            selectTimeSlot.removeClass('bg-danger').addClass('bg-success');
                            selectTimeSlot = $(this);

                            $(this).removeClass('bg-success').addClass('bg-danger');
                            let temeslotStr = $(this).attr('id').split('__')[1];
                            temeslotStr = temeslotStr.split('-');
                            lastSelectTimeSlot = temeslotStr[0] + '-' + temeslotStr[1];

                            $('input[name=id_work_scheduler]').attr('value', temeslotStr[2]);

                            $('input[name=receivingTime]').attr('value', lastSelectTimeSlot);

                            selectTimeSlot = $(this);
                        }


                    });
                });
                const id = $(this).attr('href');
                const backHeight = $(document).height();
                const backWidth = $(window).width();
                $('#back').css({'width': backWidth, 'height': backHeight});
                $('#back').fadeIn(300);
                $('#back').fadeTo(300, 0.8);
                const winH = $(window).height();
                const winW = $(window).width();
                $(id).css('top', winH / 2.1 - $(id).height() / 2);
                $(id).css('left', winW / 2.1 - $(id).width() / 2);
                $(id).fadeIn(300);
            });

            $('.window .close').click(function (e) {
                e.preventDefault();
                $('button[name=modal]').attr('disabled',false);
                const id = $('input[name=id_work_scheduler]').attr('value');
                const url = `/workSchedules/${id}/updateState`;
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {},// Костыль
                    dataType: 'json',
                    success: data => {

            },
                error: err => {

                }
            });

                $('.table').remove();
                $('#back, .window').hide();
            });
            $('#back').click(function () {
                $(this).hide();
                $('.window').hide();
            });
        })
        ;

    </script>
@endsection
