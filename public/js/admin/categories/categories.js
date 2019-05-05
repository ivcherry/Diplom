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
                title: '№'
            },
            {
                field: 'name',
                title:'Название'
            }
        ];
    setKendoGrid('/admin/getPaginatedGenericTypes', 'genericTypes', 'total', model, columns, onSelectedRow);
    function onSelectedRow(e) {
        var item = this.dataItem(this.select());
        var id = item.id;
        $.get('/admin/categories/getCategories/'+id, {}, function (response) {
            $('#currentCategoryModel').html(response);
        });
    }

    $("#delete").click(function () {
        $.ajax({
            url: '/admin/categories/deleteCategory',
            data: {id: $("#genericTypeId").val()},
            dataType: 'json',
            method: 'POST',
            success: function (response) {
                var result = response[0];
                if (result.success) {
                    bootbox.alert("Удалена категория товара.");
                }
                $("#grid").data("kendoGrid").dataSource.read();
            }
        });
    });
    $(document).on('click', '#saveEdit', function () {
        var data = $("#editCategoryForm").serialize();
        $.ajax(
            {
                url: '/admin/categories/editCategory',
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
        var data = $("#addCategoryForm").serialize();
        $.ajax(
            {
                url: '/admin/categories/addCategory',
                data: data,
                method: 'POST',
                dataType: 'json',
                success: function (response) {
                    var response = response[0];
                    if(!response.success){
                        showErrorsMessage(response.message);
                    }
                    else{
                        bootbox.alert("Категория успешно добавлена.");
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