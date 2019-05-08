<div>
    <div>
        <h3>Добавить характеристику</h3>
        <input id="typeFeaturesList" style="width: 100%;"/>
        <button class="btn-modal--success" style="width: 200px; margin-top: 10px" id="addFeatureToSubCategory">Добавить</button>
    </div>

    <h2>Характеристики подкатегории <strong>"{{$type->getName()}}"</strong></h2>
    <input type="hidden" id="typeId" value="{{$type->getId()}}" />

    <br>
    <div>
        @if($type->getFeatures()->isEmpty())
        <span>Для данной подкатегории не выбрана ни одна характеристика</span>
        @endif
        <ul class="list-inline" style="overflow: scroll; margin-top: -25px">
            @foreach($type->getFeatures() as $feature)
            <li>
                <div>
                    <button class="btn-modal--danger" style="width: 35px;" id="{{$feature->getId()}}">X</button>
                    <label>{{$feature->getName()}}</label>
                </div>
            </li>
            @endforeach
        </ul>
    </div>

</div>


<script>
    $(document).ready(function () {
        $("#addFeatureToSubCategory").click(function () {
            var featureId = $("#typeFeaturesList").val();
            var typeId = $("#typeId").val();
            $.post('/admin/subCategories/addFeatureToSubCategory', {
                featureId: featureId,
                typeId: typeId
            }, function (response) {
                response = JSON.parse(response)[0];
                if (response.success) {
                    bootbox.alert(response.message);
                    $("#grid").data("kendoGrid").select($("#grid").data("kendoGrid").select());
                }
                else {
                    bootbox.alert(response.message);
                }
            });
        });
        $(".deleteFeature").click(function () {
           $.post('/admin/subCategories/deleteFeature', {typeId: $("#typeId").val(), featureId: $(this).attr('id')}, function (response) {
               response = JSON.parse(response)[0];
               if(response.success){
                   bootbox.alert(response.message);
                   $("#grid").data("kendoGrid").select($("#grid").data("kendoGrid").select());
               }
               else{
                   bootbox.alert(response.message);
               }
           });
        });
        $("#typeFeaturesList").kendoDropDownList({
            dataTextField: "name",
            dataValueField: "id",
            dataSource: {
                transport: {
                    read: {
                        dataType: "json",
                        url: "/admin/getAllFeatures",
                    }
                },
            },
            filter: 'contains'

        });
    });

</script>
