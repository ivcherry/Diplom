<div>
    <input type="hidden" value="{{json_encode($typeFeatures)}}" id="typeFeatures">
    <input type="hidden" value="{{$product->getId()}}" id="productId">
    <div class="featuresProduct">
        <label for="features"><h3>Характеристики товара "{{$product->getName()}}"</h3></label>
        <input id="featuresList" style="width:100%;" class="form-control">
    </div>

    <div id="productFeature"></div>

</div>
<script type="text/x-kendo-template" id="productFeatureTemplate">
    <div >
        <input id="featureId" type="hidden" value="#= featureId#">
        <textarea id="featureText" name="feature" class="form-control" disabled="disabled">#= value#</textarea>
        <button id="saveFeatureText" class="btn btn-default buttons-custom" disabled>Сохранить</button>
        <button id="editFeatureText" class="btn btn-default buttons-custom">Изменить</button>
    </div>
</script>
<script>
    $(document).ready(function() {
        var data = JSON.parse($("#typeFeatures").val());

        $("#featuresList").kendoDropDownList({
            dataTextField: "name",
            dataValueField: "id",
            dataSource: data,
            filter: 'contains',
            dataBound: function (e) {
                $("#featuresList").data("kendoDropDownList").select(0);
                $("#featuresList").data("kendoDropDownList").trigger('change');

            },
            change: onSelectedItem
        });

        function onSelectedItem(e) {
            var selectedFeatureId = $("#featuresList").val();
            $.post('/admin/products/getProductFeature', {
                productId: $("#productId").val(),
                featureId: selectedFeatureId
            }, function (response) {
                response = JSON.parse(response)[0];
                var template = kendo.template($("#productFeatureTemplate").html());
                if (response.success) {
                    var result = template(response.data);
                    $("#productFeature").html(result);
                }
            });
        }
    });
</script>