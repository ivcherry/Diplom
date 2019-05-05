@extends('client.layouts.clientLayout')
@section('breadcrumbs')
    {{Breadcrumbs::render('order')}}
@endsection
@section('content')
    <div class="order-form">
        <form id="orderForm" action="/order/submitOrder" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
                <span>Ваш телефон</span>
                <div>
                    <input name="phoneNumber" type='text' id="phoneNumber" class="form-control"
                           style="width: 100%; height: inherit">
                </div>
            </div>
            <div class="">
                <div>
                    <span>Выберите время получения заказа</span>
                </div>
                <div class="form-inline">
                    <label for="chooseReceivingTime">
                        <button id="chooseReceivingTime" type="button" class="btn btn-default" href="#dialog"
                                name="modal">Выбрать
                        </button>
                    </label>
                    <input required name='receivingTime' id="chooseReceivingTime"  class="readonly"
                           style="width: 100%">
                </div>
            </div>


            <div class="order-result">
                <span>Итоговая суммма к оплате:</span>
                <span>{{$summaryPrice}}</span>
            </div>
            <input id="prodId" name="id_work_scheduler" type="hidden" value="">
            <div class="text-center">
                <button class="btn btn-done" type="submit" id="orderBtn">Оформить заказ</button>
            </div>

        </form>

    </div>
    <!-- Содержимое модального окна -->
    <div id="boxes">
        <div id="dialog" class="window">

            <span><a href="#" class="close">Закрыть</a>
    </span></div>
        <div id="back"></div>
    </div>

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
                    console.log(response);
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
                    console.log(arrDates);
                    console.log(arrTimes);
                    console.log(arrTableData);

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
                        console.log(e);

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
                    data: $('#orderForm').serialize(),// Костыль
                    dataType: 'json',
                    success: data => {
                        console.log(data);
                    },
                    error: err => {
                        console.error(err);
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
@section('scripts')
    <script>
    </script>
@endsection