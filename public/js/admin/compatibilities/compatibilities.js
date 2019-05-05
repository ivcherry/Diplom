$(document).ready(function(){
    var model = {
        fields: {
            firstFeature: { field: "firstFeature", type: "string"},
            secondFeature: {field: "secondFeature", type: "string"},
            firstType: {field: "firstType", type: "string"},
            secondType: {field: "secondType", type: "string"},
            rule : {field: "rule", type: "string"},
            id: {field: "id", type: "number"}
        }
    };
    var columns =
        [
            {
                field: 'id',
                title: '№',
            },
            {
                field: 'firstType',
                title: 'Подкатерия№1',
            },
            {
                field: 'firstFeature',
                title:'Характеристика№1',
            },
            {
                field: 'secondType',
                title:'Подкатегория№2',
            },
            {
                field: 'secondFeature',
                title:'Характеристика№2',
            },
            {
                field: 'rule',
                title: 'Правило',
            }
        ];
    setKendoGrid('/admin/compatibilities/getPaginatedCompatibilities', 'compatibilities', 'total', model, columns, onSelectedRow);
    function onSelectedRow(e) {
        var item = this.dataItem(this.select());
        var id = item.id;
        $.get('/admin/compatibilities/getCompatibility/'+id, {}, function (response) {
            $('#currentCompatibilityModel').html(response);
        });
    }

    $(document).on('click', '#add', function () {
        hideErrorsMessage();
        $.get('/admin/subCategories/getAllSubCategories', function (response) {
            $("#firstTypesList").kendoDropDownList({
                dataTextField: "name",
                dataValueField: "id",
                dataSource: response,
                dataBound: function (e) {
                    var typeId = $("#firstTypesList").data("kendoDropDownList").value();
                    $.get('/admin/getFeaturesByTypeId/'+typeId,function (features) {
                        $("#firstFeaturesList").data("kendoDropDownList").enable(true);
                        $("#firstFeaturesList").data("kendoDropDownList").setDataSource(features);
                        $("#firstFeaturesList").data("kendoDropDownList").select(0);
                    });
                },
                select: function (e) {
                    $.get('/admin/getFeaturesByTypeId/'+e.dataItem.id,function (features) {
                        $("#firstFeaturesList").data("kendoDropDownList").enable(true);
                        $("#firstFeaturesList").data("kendoDropDownList").setDataSource(features);
                        $("#firstFeaturesList").data("kendoDropDownList").select(0);
                    });
                }
            });
            $("#secondTypesList").kendoDropDownList({
                dataTextField: "name",
                dataValueField: "id",
                dataSource: response,
                dataBound: function (e) {
                    var typeId = $("#secondTypesList").data("kendoDropDownList").value();
                    $.get('/admin/getFeaturesByTypeId/'+typeId,function (features) {
                        $("#secondFeaturesList").data("kendoDropDownList").enable(true);
                        $("#secondFeaturesList").data("kendoDropDownList").setDataSource(features);
                        $("#secondFeaturesList").data("kendoDropDownList").select(0);
                    });
                },
                select: function (e) {
                    $.get('/admin/getFeaturesByTypeId/'+e.dataItem.id,function (features) {
                        $("#secondFeaturesList").data("kendoDropDownList").enable(true);
                        $("#secondFeaturesList").data("kendoDropDownList").setDataSource(features);
                        $("#secondFeaturesList").data("kendoDropDownList").select(0);
                    });
                }
            });
        });

        $("#firstFeaturesList").kendoDropDownList({
            dataTextField: "name",
            dataValueField: "id",
            enable: false
        });
        $("#secondFeaturesList").kendoDropDownList({
            dataTextField: "name",
            dataValueField: "id",
            enable: false
        });

    });

     $("#delete").click(function () {
         $.ajax({
             url: '/admin/compatibilities/deleteCompatibility',
             data: {id: $("#compatibilityId").val()},
             dataType: 'json',
             method: 'POST',
             success: function (response) {
                 var result = response[0];
                 if (result.success) {
                     bootbox.alert("Совместимость успешно удалена.");
                 }
                 $("#grid").data("kendoGrid").dataSource.read();
             }
         });
     });
     $(document).on('click', '#saveAdd', function () {
         var data = $("#addFeatureForm").serialize();
        $.ajax(
            {
                url: '/admin/compatibility/addCompatibility',
                data: data,
                method: 'POST',
                dataType: 'json',
                success: function (response) {
                    var response = response[0];
                    if(!response.success){
                        showErrorsMessage(response.message);
                    }
                    else{
                        bootbox.alert("Характеристика успешно добавлена.");
                        $("#cancelAdd").click();
                        $("#grid").data("kendoGrid").dataSource.read();
                    }
                }
            }
        );
    })
     $(document).on('click', '#add', function () {
         hideErrorsMessage();
     });
});

function showErrorsMessage(errors) {
    $(".errors").find("ul").html('');
    $(".errors").css("display", "block");
    $.each(errors, function (key, value) {
        $(".errors").find("ul").append('<li>'+value+'</li>');
    });
}
function hideErrorsMessage(){
    $(".errors").hide();
}
