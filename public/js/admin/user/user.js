$(document).ready(function(){
    var model = {
        fields: {
            id: {field: "id", type: "number"},
            email: {field: "email", type: "string"},
            fullName: { field: "fullName", type: "string"}
        }
    };
    var columns =
        [
            {
                field: 'id',
                title: '№',
            },
            {
                field: 'email',
                title:'Почта',
            },
            {
                field: 'fullName',
                title:'Полное имя',
            }
        ];
    setKendoGrid('/admin/user_data/getPaginatedUsers', 'users', 'total', model, columns, onSelectedRow);
    function onSelectedRow(e) {
        var item = this.dataItem(this.select());
        var id = item.id;
        $.get('/admin/user_data/getUser/'+id, {}, function (response) {
            $('#currentUserModel').html(response);
        });
    }

    $("#delete").click(function () {
        $.ajax({
            url: '/admin/user_data/deleteUser',
            data: {id: $("#userId").val()},
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
    $(document).on('click', '#saveEditRoles', function () {
        var data = $("#editUserRolesForm").serialize();
        console.log(data);
        $.ajax(
            {
                url: '/admin/user_data/editUser',
                data: data,
                method: "POST",
                dataType: 'json',
                success: function (data) {
                    $("#cancelEdit").click();
                    var result = data[0];
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
