$(document).ready(function(){
    var model = {
        fields: {
            name: { field: "name", type: "string"},
            id: {field: "id", type: "number"},
            price: {field: "price", type: "number"},
            amount: {field: "amount", type:"number"},
            subCategory: {field: "type", type:"string"},
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
            {
                field:'price',
                title:'Цена(руб)',
            },
            {
                field:'amount',
                title:'Кол-во'
            },
            {
                field:'subCategory',
                title:'Подкатегория'
            }
        ];
    setKendoGrid('/admin/products/getAllProducts', 'products', 'total', model, columns, onSelectedRow);
    function onSelectedRow(e) {
        var item = this.dataItem(this.select());
        var id = item.id;
        $.get('/admin/products/getProduct/'+id, {}, function (response) {
            $('#currentProductsModel').html(response);
        });
    }
    $("#delete").click(function () {
        $.ajax({
            url: '/admin/products/deleteProduct',
            data: {id: $("#productId").val()},
            dataType: 'json',
            method: 'POST',
            success: function (response) {
                var result = response[0];
                if (result.success) {
                    bootbox.alert("Товар успешно удален.");
                }
                $("#grid").data("kendoGrid").dataSource.read();
            }
        });
    });
    $(document).on('click', '#saveEdit', function () {

        var data = $("#editProductForm").serialize();
        $.ajax(
            {
                url: '/admin/products/editProduct',
                data: data,
                method: "POST",
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
        var data = $("#addProductForm").serialize();
        $.ajax(
            {
                url: '/admin/products/addProduct',
                data: data,
                method: 'POST',
                dataType: 'json',
                success: function (response) {
                    var response = response[0];
                    if(!response.success){
                        showErrorsMessage(response.message);
                    }
                    else{
                        bootbox.alert("Товар успешно добавлен.");
                        $("#cancelAdd").click();
                        $("#grid").data("kendoGrid").dataSource.read();
                    }
                }
            });
    });
    $("#add").click(function () {
        hideErrorsMessage();
        $("#addPrice").kendoNumericTextBox({
            format: "#.00 руб"
        });
        $("#addAmount").kendoNumericTextBox(
            {format: "#"}
        );

        $("#subCategoryDropDownAdd").kendoDropDownList({
            dataTextField: "name",
            dataValueField: "id",
            dataSource: {
                transport: {
                    read: {
                        dataType: "json",
                        url: "/admin/subCategories/getAllSubCategories",
                    }
                },
            }
        });
    });
    $(document).on('click','#edit', function () {
        hideErrorsMessage();
        $("#price").kendoNumericTextBox({
            format: "#.00 руб"
        });
        $("#amount").kendoNumericTextBox(
            {format: "#"}
        );
        $("#subCategoryDropDown").kendoDropDownList({
            dataTextField: "name",
            dataValueField: "id",
            dataSource: {
                transport: {
                    read: {
                        dataType: "json",
                        url: "/admin/subCategories/getAllSubCategories",
                    }
                },
            }
        });
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