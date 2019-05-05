$(document).ready(function () {

    $("#saveHistory").click(function () {
        var content = tinymce.get("historyContent").getContent();
        $.post('/admin/companyHistory/saveContent', {historyContent:content}, function (response) {
            response = JSON.parse(response)[0];
            bootbox.alert(response.message);
        });
    });
});