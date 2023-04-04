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

    $('#dropDown').on('change', function() {
        if(this.value == 'Admin'){
            return $('#loginFrm').attr('action','/admin/login');           
        }
        if(this.value == 'Employee'){
            return $('#loginFrm').attr('action','/employee/login');           
        }
        if(this.value == 'Developer'){
            return $('#loginFrm').attr('action','/developer/login');           
        }
        if(this.value == 'Agency'){
            return $('#loginFrm').attr('action','/agency/login');           
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
            },
            image: {
                filesize: 5,
            }
        },
        messages: {
            name: "Please provide a name",
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
