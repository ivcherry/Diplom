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
    setKendoGrid('/admin/getPaginatedSubCategories', 'types', 'total', model, columns, onSelectedRow);
    function onSelectedRow(e) {
        var item = this.dataItem(this.select());
        var id = item.id;
        $.get('/admin/subCategories/getSubCategoryFeatures/'+id, {}, function (response) {
            $('#subCategoryFeatures').html(response);
        });
    }

});