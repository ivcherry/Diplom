$(document).ready(function(){
    var model = {
        fields: {
            name: { field: "name", type: "string"},
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
                field: 'name',
                title:'Название',
            }
        ];
    setKendoGrid('/admin/features/getPaginatedFeatures', 'features', 'total', model, columns, onSelectedRow);
    function onSelectedRow(e) {
        var item = this.dataItem(this.select());
        var id = item.id;
        $.get('/admin/features/getFeatures/'+id, {}, function (response) {
            $('#currentFeatureModel').html(response);
        });
    }

    $("#delete").click(function () {
        $.ajax({
            url: '/admin/features/deleteFeature',
            data: {id: $("#featureId").val()},
            dataType: 'json',
            method: 'POST',
            success: function (response) {
                var result = response[0];
                if (result.success) {
                    bootbox.alert("Удалена характеристика товара.");
                }
                $("#grid").data("kendoGrid").dataSource.read();
            }
        });
    });
    $(document).on('click', '#saveEdit', function () {
        var data = $("#editFeatureForm").serialize();
        $.ajax(
            {
                url: '/admin/features/editFeature',
                data: data,
                method: "POST",
                dataType: 'text',
                success: function (data) {
                    $("#cancelEdit").click();
                    var result = $.parseJSON(data)[0];
                    if(result.success){
                        bootbox.alert("Сохранение изменений произошло успешно!");
                    }
                    $("#grid").data("kendoGrid").dataSource.read();
                }
            });
    });
    $(document).on('click', '#cancelEdit', function () {
        $("#add, #delete, #edit").removeAttr('disabled');
        $(".confirmation-buttons").hide();
    });
    $(document).on('click', '#saveAdd', function () {
        var data = $("#addFeatureForm").serialize();
        $.ajax(
            {
                url: '/admin/features/addFeature',
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
