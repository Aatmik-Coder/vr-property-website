$(document).on('change',"#image",function() {
    displaySelectedImage(this,'image_preview');
})
$(document).ready(function () {
    'use strict';
    $("#devloginFrm").validate({
        errorElement: 'span',
        rules: {
            person_email: {
                required: true,
                email: true
            },
            person_password: {
                required: true
            }
        },
        messages: {
            person_password: {
                required: "Please provide a password"
            },
            person_email: "Please enter a valid email address"
        }
    });

    $("#devchangeFrm").validate({
        errorElement: 'span',
        rules: {
            current_password: {
                required: true,
                minlength: 8
            },
            person_password: {
                required: true,
                minlength: 8
            },
            password_confirmation: {
                required: true,
                minlength: 8,
                equalTo: "#password"
            }
        },
        messages: {
            current_password: {
                required: "Please provide a current password",
                minlength: "Your password must be at least 8 characters long"
            },
            person_password: {
                required: "Please provide a new password",
                minlength: "Your password must be at least 8 characters long"
            },
            password_confirmation: {
                required: "Please provide a confirm password",
                minlength: "Your password must be at least 8 characters long",
                equalTo: "Please enter the same password as above"
            },
            person_email: "Please enter a valid email address"
        }
    });

    $("#passwordFrm").validate({
        errorElement: 'span',
        rules: {
            person_email: {
                required: true,
                email: true
            }
        },
        messages: {
            person_email: "Please enter a valid email address"
        }
    });

    $("#profileFrm").validate({
        errorElement: 'span',
        rules: {
            person_email: {
                required: true,
                email: true
            },
            name: {
                required: true
            },
            image: {
                filesize: 5,
            }
        },
        messages: {
            name: "Please provide a name",
            person_email: "Please enter a valid email address"
        }
    });

    $("#resetFrm").validate({
        errorElement: 'span',
        rules: {
            person_email: {
                required: true,
                email: true
            },
            person_password: {
                required: true,
                minlength: 8
            },
            password_confirmation: {
                required: true,
                minlength: 8,
                equalTo: "#password"
            }
        },
        messages: {
            person_password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 8 characters long"
            },
            password_confirmation: {
                required: "Please provide a password",
                minlength: "Your password must be at least 8 characters long",
                equalTo: "Please enter the same password as above"
            },
            person_email: "Please enter a valid email address"
        }
    });

});
