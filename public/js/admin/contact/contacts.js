$(document).ready(function () {

    $("#saveContacts").click(function () {
        var content = tinymce.get("contactsContent").getContent();
        $.post('/admin/contacts/saveContent', {contactsContent:content}, function (response) {
            response = JSON.parse(response)[0];
            bootbox.alert(response.message);
        });
    });
});
