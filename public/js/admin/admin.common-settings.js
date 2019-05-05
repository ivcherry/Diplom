$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    jQuery.ajaxSetup({
        beforeSend: function() {
            $('#loader').show();
        },
        complete: function(){
            $('#loader').hide();
        },
        success: function() {}
    });
    $(".k-grid-pager").kendoPager({
        info:false
    });
});

function setKendoGrid(dataUrl, jsonData, total, model, columns, onchangeHandler) {
        var dataSource = new kendo.data.DataSource({
            transport: {
                read: {
                    url: dataUrl,
                    dataType: 'json'
                }
            },
            schema: {
                type: "json",
                data: jsonData,
                total: total,
                model: model
            },
            pageSize:10,
            serverPaging: true,
            requestStart: function () {
                kendo.ui.progress($("#grid"), false);
            }
        });
        $("#grid").kendoGrid({
            columns: columns,
            dataSource: dataSource,
            selectable:true,
            dataBound:function (e) {
                $("#grid").data("kendoGrid").select('tr:eq(0)');
            },
            change: onchangeHandler,
            pageable: true
        });
}
