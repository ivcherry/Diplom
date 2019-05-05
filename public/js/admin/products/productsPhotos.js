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
        $.get('/admin/products/getProductPhotos/'+id, {}, function (response) {
            $('#currentProductsPhotosModel').html(response);
        });
    }

    $(document).on('click', '#addPhotos', function (e) {
        e.preventDefault();
        var files = $("#images").data('kendoUpload').getFiles().map(function (item) {
            return item.rawFile;
        });

        var data = new FormData();
        data.append('productId', $("#productId").val());
        $.each(files, function (i,file) {
            data.append('file-'+i, file);
        });
        $.ajax(
            {
                url: '/admin/products/addProductPhotos',
                data:  data,
                method: 'POST',
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    var response = JSON.parse(response)[0];
                    if(!response.success){
                        bootbox.alert(response.message);
                    }
                    else{
                        bootbox.alert("Фотографии успешно добавлены.");
                        $("#grid").data("kendoGrid").dataSource.read();
                    }
                }
            });
    });
    $(document).on('click', '.deletePhoto', function (e) {
       var photoId = $(this).attr('id');
       var productId = $("#productId").val();
       $.post('/admin/products/deleteProductPhoto', {photoId: photoId, productId: productId}, function (response) {
           response = JSON.parse(response)[0];
           if(response.success){
               bootbox.alert("Фотография товара успешно удалена");
               //$("#grid").data("kendoGrid").dataSource.read();
               $("#grid").data("kendoGrid").select($("#grid").data("kendoGrid").select());
           }
       });
    });
});
