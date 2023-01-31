$(document).on('change',"#image",function() {
    displaySelectedImage(this,'image_preview');
})
$(document).ready(function () {
    'use strict';
    $("#loginFrm").validate({
        errorElement: 'span',
        rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true
            }
        },
        messages: {
            password: {
                required: "Please provide a password"
            },
            email: "Please enter a valid email address"
        }
    });

    $("#registerFrm").validate({
        errorElement: 'span',
        rules: {
            email: {
                required: true,
                email: true
            },
            first_name: {
                required: true
            },
            last_name: {
                required: true
            },
            nick_name: {
                required: true
            },
            password: {
                required: true,
                minlength: 8
            },
            password_confirmation: {
                required: true,
                minlength: 8,
                equalTo: "#password"
            },
            agree: {
                required: true,
            }
        },
        messages: {
            email: "Please enter a valid email address",
            first_name: {
                required: "Please provide a First name"
            },
            last_name: {
                required: "Please provide a Last name"
            },
            nick_name: {
                required: "Please provide a nickname"
            },
            password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 8 characters long"
            },
            password_confirmation: {
                required: "Please provide a confirm password",
                minlength: "Your password must be at least 8 characters long",
                equalTo: "Please enter the same password as above"

            },
            agree: {
                required: "Please check the checkbox to agree our terms & conditions.",
            }
        }
    });

    $("#changeFrm").validate({
        errorElement: 'span',
        rules: {
            current_password: {
                required: true,
                minlength: 8
            },
            password: {
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
            password: {
                required: "Please provide a new password",
                minlength: "Your password must be at least 8 characters long"
            },
            password_confirmation: {
                required: "Please provide a confirm password",
                minlength: "Your password must be at least 8 characters long",
                equalTo: "Please enter the same password as above"
            },
            email: "Please enter a valid email address"
        }
    });

    $("#passwordFrm").validate({
        errorElement: 'span',
        rules: {
            email: {
                required: true,
                email: true
            }
        },
        messages: {
            email: "Please enter a valid email address"
        }
    });

    $("#profileFrm").validate({
        errorElement: 'span',
        rules: {
            email: {
                required: true,
                email: true
            },
            name: {
                required: true
            }
        },
        messages: {
            name: {
                required: "Please provide a name"
            },
            email: "Please enter a valid email address"
        }
    });

    $("#resetFrm").validate({
        errorElement: 'span',
        rules: {
            email: {
                required: true,
                email: true
            },
            password: {
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
            password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 8 characters long"
            },
            password_confirmation: {
                required: "Please provide a password",
                minlength: "Your password must be at least 8 characters long",
                equalTo: "Please enter the same password as above"
            },
            email: "Please enter a valid email address"
        }
    });

});
