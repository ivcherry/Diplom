$(document).ready(function () {

    $("#saveHowToFindUs").click(function () {
        var content = tinymce.get("howToFindUsContent").getContent();
        $.post('/admin/howToFindUs/saveContent', {howToFindUsContent:content}, function (response) {
            response = JSON.parse(response)[0];
            bootbox.alert(response.message);
        });
    });
});
