$(document).on('change',"#image",function() {
    displaySelectedImage(this,'image_preview');
});
$('#tags').tagsinput({
    maxTags: 10
});
$(".upload-button").on("click", function () {
    $(".file-upload").click();
});
$(document).ready(function () {
    'use strict';
    $("#frmImage").validate({
        ignore : [],
        errorElement: 'span',
        rules: {
            image: {
                required: true,
                filesize : 20,
            },
            title: {
                required: true,
            },
            description: {
                required: true
            },
            location: {
                required: true
            },
            tags: {
                required: true
            }
        },
        messages: {
            image: "Please select an image",
            title: "Please provide an image title",
            description: "Please provide an image description",
            location: "Please provide an image location",
            tags: "Please provide an image tags",
        }
    });

});
