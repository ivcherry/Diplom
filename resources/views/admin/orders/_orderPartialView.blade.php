<div class="model-data">
    <h3>Заказ №{{$orderModel->getId()}}</h3>
    <input type="hidden" id="orderId" value="{{$orderModel->getId()}}">
    <div class="row">
        <label for="name">Дата заказа:</label>
        <input type="text" name="name" class="" id="dateOfOrder"
               value="{{$orderModel->getDateOfOrder()->format('Y-m-d')}}" disabled="disabled"
               width="300"/>

    </div>
    <div class="row">
        <label for="name">Сумма заказа:</label>
        <input type="text" name="name" class="" id="totalPrice" value="{{$orderModel->getTotalPrice()}}"
               disabled="disabled"
               width="300"/>
    </div>

    <div class="row">
        <label for="name">Имя владельца:</label>
        <input type="text" name="name" class="" id="name_user" value="{{$orderModel->getUser()->getFullName()}}"
               disabled="disabled"
               width="300"/>
    </div>
    <div class="row">
        <label for="name">Продукты:</label>
        <div></div>
        <div style="margin-left: 4%">
            @foreach($products as $product)
                <div>
                    <label for="name">Название:</label>
                    <input type="text" name="name" class="" id="dateOfReceiving"
                           value="{{$product->getProduct()->getName()}}"
                           disabled="disabled" width="300"/>
                </div>

                <div>
                    <label for="name">Количество:</label>
                    <input type="text" name="name" class="" id="dateOfReceiving" value="{{$product->getAmount()}}"
                           disabled="disabled" width="300"/>
                </div>
                <div>
                    <label for="name">Цена:</label>
                    <input type="text" name="name" class="" id="dateOfReceiving" value="{{$product->getPrice()}}"
                           disabled="disabled" width="300"/>
                </div>
                </br>
            @endforeach
        </div>
    </div>


</div>