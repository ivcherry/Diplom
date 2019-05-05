$(document).ready(function () {
    var model = {
        fields: {
            title: {field: "title", type: "string"},
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
                field: 'title',
                title: 'Время заказа'
            }
        ];
    setKendoGrid('/admin/orders/getPaginate', 'orders', 'total', model, columns, onSelectedRow);

    function onSelectedRow(e) {
        var item = this.dataItem(this.select());
        var id = item.id;
        $.get('/admin/orders/getOrder/' + id, {}, function (response) {
            $('#currentOrderModel').html(response);
        });
    }

    $("#delete").click(function () {
        $.ajax({
            url: '/admin/orders/delete',
            data: {id: $("#orderId").val()},
            dataType: 'json',
            method: 'POST',
            success: function (response) {
                var result = response[0];
                if (result.success) {
                    bootbox.alert("Удалена новость.");
                }
                $("#grid").data("kendoGrid").dataSource.read();
            }
        });
    });
    $(document).on('click', '#saveEdit', function () {
        var data = $("#editOrderForm").serialize();
        $.ajax(
            {
                url: '/admin/orders/edit',
                data: data,
                method: "POST",
                dataType: 'text',
                success: function (data) {
                    $("#cancelEdit").click();
                    var result = $.parseJSON(data)[0];
                    if (result.success) {
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
        var data = $("#addOrderForm").serialize();
        $.ajax(
            {
                url: '/admin/orders/add',
                data: data,
                method: 'POST',
                dataType: 'json',
                success: function (response) {
                    var response = response[0];
                    if (!response.success) {
                        showErrorsMessage(response.message);
                    }
                    else {
                        bootbox.alert("Акция успешно добавлена.");
                        $("#cancelAdd").click();
                        $("#grid").data("kendoGrid").dataSource.read();
                    }
                }
            }
        );
    });
    $(document).on('click', '#add', function () {
        hideErrorsMessage();
    });
});

function showErrorsMessage(errors) {
    $(".errors").find("ul").html('');
    $(".errors").css("display", "block");
    $.each(errors, function (key, value) {
        $(".errors").find("ul").append('<li>' + value + '</li>');
    });
}

function hideErrorsMessage() {
    $(".errors").hide();
}