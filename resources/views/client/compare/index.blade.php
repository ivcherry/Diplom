@extends('client.layouts.clientLayout')

@section('breadcrumbs')
<div>
    {{Breadcrumbs::render('compare')}}
</div>
@endsection

@section('content')
<h1>Сравнение товаров</h1>
<div class="compare-products" >
  <div id="emptyCompare" style={{empty($products)?"":"display:none"}}>
      <p>Вы не выбрали ни одного товара. Для добавления товаров перейдите в <a href="/catalog">каталог</a></p>
  </div>
  <div id="productCompare">
      @if(!empty($products))
      <div style="overflow-x:scroll;">
      <table>
        <thead>
            <tr>
              <td>
                    <div class="delete-products">
                        <button class="btn btn-danger delete-products-btn">Очистить</button>
                    </div>
              </td>
              @foreach ($products as $product)
                <td> <input type="hidden" class="hiddenProductId" value="{{$product->getId()}}" >
                      <a href="/product/{{$product->getId()}}" style='color:black'>{{ $product->getName() }}</a>
                </td>
              @endforeach
          </tr>
          <tr>
              <td>  </td>
              @foreach ($products as $product)
                <td>
                  @if  ( $product->getPhotos()->isEmpty() )
                  <img src="/css/Default/image-not-available.jpg" alt="Фото отсутствует"/>
                  @else
                  <img src="/storage{{ $product->getPhotos()->first()->getImage() }}" alt="Фото"/>
                  @endif
                </td>
              @endforeach
          </tr>
          <tr>
              <td>  </td>
              @foreach ($products as $product)
                <td> {{ $product->getPrice() }} рублей</td>
              @endforeach
          </tr>
       </thead>

       <tbody>
          @foreach ($features as $feature)
            <tr>
            <td> {{$feature->getName()}} </td>
              @foreach ($products as $product)
                <td> @php
                      $value = "N/A";
                      $feature_p = $product->getFeatures()->filter(
                      function($item) use($feature) {return $item->getFeature()->getId() === $feature->getId();});
                      if (!$feature_p->isEmpty()) $value = $feature_p->first()->getValue()
                     @endphp
                    {{ $value }}
                </td>
              @endforeach
            </tr>
          @endforeach
       </tbody>
     </table>
      </div>
      @endif
  </div>
</div>
@endsection

@section('scripts')
<script>
$(function () {
    $(".delete-products-btn").click(function (e) {
        $.get(
            '/deleteComparedProduct',
            function (response) {
                response = JSON.parse(response)[0];
                if(response.success){
                    $('.compare-product-count').text(response.data.comparedCount);
                    if(response.data.comparedCount == 0){
                        $("#productCompare").hide();
                        $("#emptyCompare").show();
                    }
                }
            }
        );
    })
});
</script>
@endsection
