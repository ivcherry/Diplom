$(document).ready(function(){
    var model = {
        fields: {
            name: { field: "name", type: "string"},
            id: {field: "id", type: "number"},
        }
    };
    var columns =
        [
            {
                field: 'id',
                title: '№',
            },
            {
                field: 'name',
                title:'Название',
            },
        ];
    setKendoGrid('/admin/products/getAllProducts', 'products', 'total', model, columns, onSelectedRow);
    function onSelectedRow(e) {
        var item = this.dataItem(this.select());
        var id = item.id;
        $.get('/admin/products/getProductFeatures/'+id, {}, function (response) {
            $('#currentProductFeaturesModel').html(response);
        });
    }

    $(document).on('click','#editFeatureText',function () {
            $("#saveFeatureText").removeAttr('disabled');
            $("#featureText").removeAttr('disabled');
        });
    $(document).on('click','#saveFeatureText',function () {
            var featureId = $("#featureId").val();
            var featureValue = $("#featureText").val();
            $.post('/admin/products/saveFeatureValue',
                {
                    productId: $("#productId").val(),
                    featureId: featureId,
                    value: featureValue
                },
                function (response) {
                    response = JSON.parse(response)[0];
                    if(response.success){
                        $("#saveFeatureText").prop('disabled', true);
                        $("#featureText").prop('disabled', true);
                        bootbox.alert(response.message);
                    }
                    else{
                        bootbox.alert(response.message);
                    }
                })
    });

});
