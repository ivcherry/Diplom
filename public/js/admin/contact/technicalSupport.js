$(document).ready(function () {

    $("#saveTechnicalSupport").click(function () {
        var content = tinymce.get("technicalSupportContent").getContent();
        $.post('/admin/technicalSupport/saveContent', {technicalSupportContent:content}, function (response) {
            response = JSON.parse(response)[0];
            bootbox.alert(response.message);
        });
    });
});
