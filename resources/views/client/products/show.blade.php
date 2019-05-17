@extends('client.layouts.clientLayout')


@section('content')


    <div class="productBlock k-widget k-listview" id="productBlock" >
        <div class="product">
          <input id="prodId" hidden value='{{ $product->getId() }}'/>
          <h1>{{ $product->getName() }}</h1>
            <div class="photo inline">
                  @if  ( $product->getPhotos()->isEmpty() )
                  <img src="/css/Default/image-not-available.jpg" alt="Фото отсутствует"/>
                  @else
                  <img src="/storage{{ $product->getPhotos()->first()->getImage() }}" alt="Фото"/>
                  @endif
            </div>
            <div class='summary inline'>
                  <p class='price'>{{ $product->getPrice() }} P.</p>
                  <p class='prod'>Производитель: {{ $product->getProducer() }}</p>
                  <p class='desc'>{{ $product->getDescription() }}</p>
                  <div>
                      <div class="addToCompareBlock">
                        @if($isInCompare)
                          <button class="btn btn-default"><a href="/compare">В сравнении</a></button>
                        @elseif(!($compareAllowed))
                          <button id='not-allowed' class="btn btn-default">Невозможно добавить</button>
                          <div id='not-allowed-notice' class='not-allowed-notice' style="display: none;"> очистите свой список сравнения </div>
                        @else
                          <button class="btn" id="compareBtn" >
                              <img src="/css/Default/compare.png" />
                          </button>
                        @endif
                      </div>

                      <div class="addToCart">
                          @if($product->getAmount() > 0)
                              @if($isInCart)
                                <button class="btn btn-default"><a href="/shoppingCart">В корзине</a></button>
                              @else
                                  <button class="btn" id="addToCartBtn">
                                      <img src="/css/Default/cart.png" />
                                      <span>Купить</span>
                                  </button>
                              @endif
                          @else
                              <span><h4>Нет в наличии</h4></span>
                          @endif
                      </div>

                  </div>
            </div>
            <div class='info'>
                  <div class="tab">
                    <button class="tablinks" onclick="openTab(event, 'Features')" id="defaultOpen"> <h4>Характеристики</h4></button>
                    <button class="tablinks" onclick="openTab(event, 'Reviews')"><h4>Отзывы</h4></button>
                  </div>

                  <div id="Features" class="tabcontent">
                    <h3>Характеристики</h3>

                    <table>
                     <tbody>
                        @foreach ($features as $feature)
                          <tr>
                          <td> {{$feature->getName()}} </td>
                              <td> @php
                                    $value = "N/A";
                                    $feature_p = $product->getFeatures()->filter(
                                    function($item) use($feature) {return $item->getFeature()->getId() === $feature->getId();});
                                    if (!$feature_p->isEmpty()) $value = $feature_p->first()->getValue()
                                   @endphp
                                  {{ $value }}
                              </td>
                          </tr>
                        @endforeach
                     </tbody>
                    </table>

                  </div>

                  <div id="Reviews" class="tabcontent">
                    <h3>Отзывы</h3>
                    <p></p>
                  </div>

            </div>
        </div>
    </div>



@endsection


@section('scripts')

<script src="/js/common-settings.js"></script>
<script>
document.getElementById("defaultOpen").click();

function openTab(evt, Name) {
    // Declare all variables
    var i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(Name).style.display = "block";
    evt.currentTarget.className += " active";
}
</script>


<script>
        $(function(){
           $("#addToCartBtn").click(function () {
               $.post('/shoppingCart/addToCart', {prodId: $("#prodId").val()}, function (response) {
                   response = JSON.parse(response)[0];
                   if(response.success){
                       if(response.data.productsCount) {
                           $('.cart-product-count').text(response.data.productsCount);
                       }
                   }
               })
           });
        });

$(function() {
    $("#compareBtn").click(function() {
        $.post('/addToCompare', { prodId:$("#prodId").val() },
              function(response){
                   response = JSON.parse(response)[0];
                   if (response.success) {
                     if(response.data.comparedCount) {
                            $(".compare-product-count").text(response.data.comparedCount);
                      }
                   }
              });
    });

    $('#not-allowed').hover(function() {
        $('#not-allowed-notice').show();
    }, function() {
        $('#not-allowed-notice').hide();
    });
});

</script>
@endsection
