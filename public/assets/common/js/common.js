var myTimeZone = getCookie('myTimeZone');
console.log('myTimeZone', myTimeZone);
console.log('JS My Time Zone', moment.tz.guess());
console.log('JS UTC Time', moment().utc().format("YYYY-MM-DD HH:mm:ss"));
console.log('JS Local Time', moment().format("YYYY-MM-DD HH:mm:ss"));
createCookie('myTimeZone', moment.tz.guess(), 30);
if(!myTimeZone) {
    $('.loader').show();
    window.location.reload();
}

var days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
var occurances = ['first', 'second', 'third', 'fourth'];
$('.loader').show();
$(document).on('submit', 'form', function () {
    $('.loader').show();
});

var segments = location.pathname.split('/');
toastr.options.timeOut = 20000;
$.validator.addMethod('filesize', function (value, element, param) {
    return this.optional(element) || (element.files[0].size <= param * 1000000)
}, 'File size must be less than {0} MB');

$.validator.addMethod("emailValidate", function(value, element) {
    return this.optional(element) || /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i.test(value);
}, "Please enter valid email address!");

$.validator.addMethod("extension", function (value, element, param) {
    param = typeof param === "string" ? param.replace(/,/g, '|') : "png|jpe?g|gif";
    return this.optional(element) || value.match(new RegExp(".(" + param + ")$", "i"));
}, "Please enter a value with a valid extension.");

window.onpageshow =function(event){
    if(event.persisted){
        location.reload();
    }
};

$(document).ready(function () {
    $('.loader').hide();
    'use strict';
    displayPlaceholderAsLabel();

    /* Siderbasr navigation menu active */
    $('.childmenu li.active').parent().closest('li').addClass('active');
    $('.childmenu li.active').parent().closest('ul').addClass('show');
    $('.mainmenu li.active').find('a:first.show').attr('aria-expanded', 'true');
    if ($('.childmenu').length > 0) {
        $.each($('.childmenu'), function () {
            var $this = $(this);
            if ($this.find('li').length == 0) {
                $this.parent().closest('li').remove();
            }
        });
    }
    /* END */
    // ------------------------------------------------------- //
    // Sidebar Functionality
    // ------------------------------------------------------ //
    $('#toggle-btn').on('click', function (e) {
        e.preventDefault();
        $(this).toggleClass('active');

        $('.side-navbar').toggleClass('shrinked');
        $('.content-inner').toggleClass('active');
        $(document).trigger('sidebarChanged');

        if ($(window).outerWidth() > 1183) {
            if ($('#toggle-btn').hasClass('active')) {
                $('.navbar-header .brand-small').hide();
                $('.navbar-header .brand-big').show();
            } else {
                $('.navbar-header .brand-small').show();
                $('.navbar-header .brand-big').hide();
            }
        }

        if ($(window).outerWidth() < 1183) {
            $('.navbar-header .brand-small').show();
        }
    });
    // $('#toggle-btn').trigger('click');

    // ------------------------------------------------------- //
    // Material Inputs
    // ------------------------------------------------------ //

    var materialInputs = $('input.input-material');

    // activate labels for prefilled values
    materialInputs.filter(function () { return $(this).val() !== ""; }).siblings('.label-material').addClass('active');

    // move label on focus
    materialInputs.on('focus', function () {
        displayPlaceholderAsLabel();
    });
    // remove/keep label on blur
    materialInputs.on('keyup', function () {
        displayPlaceholderAsLabel();
    });
    materialInputs.on('blur', function () {
        displayPlaceholderAsLabel();
    });

    // ------------------------------------------------------- //
    // Footer
    // ------------------------------------------------------ //

    var contentInner = $('.content-inner');

    $(document).on('sidebarChanged', function () {
        adjustFooter();
    });

    $(window).on('resize', function () {
        adjustFooter();
    })

    function adjustFooter() {
        var footerBlockHeight = $('.main-footer').outerHeight();
        contentInner.css('padding-bottom', footerBlockHeight + 'px');
    }

    if (emsg && emsg != "") {
        toastr.clear();
        if (ecls == "error") {
            toastr.error(emsg);
        } else {
            toastr.success(emsg);
        }
    }

    $(document).on('change', "input[type=file]", function (e) {
        var fileName = e.target.files[0].name;
        $(this).parents('.form-fileUpload').find(".uploadFile").text(fileName);
        displaySelectedImage(this, $(this).attr('id') + '_preview');
    });
});

function displayPlaceholderAsLabel() {
    $.each($('input.input-material'), function () {
        var $this = $(this);
        if ($this.val())
            $this.siblings('.label-material').addClass('active');
        else
            $this.siblings('.label-material').removeClass('active');
    });
    $.each($('select.input-material'), function () {
        var $this = $(this);
        if ($this.val())
            $this.siblings('.label-material').addClass('active');
        else
            $this.siblings('.label-material').removeClass('active');
    });
}

function displaySelectedImage(input, previewid) {
    if (input.files && input.files[0]) {
        var mimeType = input.files[0]['type'];//mimeType=image/jpeg or application/pdf etc...
        // console.log(mimeType);
        // alert("#div_"+previewid);
        $("#div_"+previewid).hide();
        if (mimeType.split('/')[0] === 'video') {
            $('#' + previewid).hide();
            $('#' + previewid + "_video").hide();

            $("#div_"+previewid).html('<video controls playsinline loop class="video_preview"><source src="'+window.URL.createObjectURL(input.files[0])+'" type="video/mp4"><source src="'+window.URL.createObjectURL(input.files[0])+'" type="video/ogg">Your browser does not support the video tag.</video>');
            $("#div_"+previewid).show();
        } else if (mimeType.split('/')[0] === 'image') {
            $('#' + previewid).show();
            $('#' + previewid + "_video").hide();
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#' + previewid).attr('src', e.target.result);

                $("#div_"+previewid).html('<img src="'+e.target.result+'" class="img-fluid image_preview">');
            }
            reader.readAsDataURL(input.files[0]);
            $("#div_"+previewid).show();
        }
    }
}

function getRndInteger(min, max) {
    return Math.floor(Math.random() * (max - min)) + min;
}


function updateStatus(id, title, body) {
    var table = $("#data-table").DataTable();
    var url = baseUrl + segments[2] + "/status";
    if (title == "") {
        title = "Do you really want to change the status?";
    }
    if (body == "") {
        body = "If you select yes, " + segments[2].replace('_', ' ') + " status will be change.";
    }

    $.prompt(body, {
        title: title,
        buttons: { "No": false, "Yes": true },
        focus: 1,
        submit: function (e, v, m, f) {
            if (v) {
                e.preventDefault();
                $('.loader').show();
                $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': _token
                    },
                    url: url,
                    data: { id: id },
                    success: function (data) {
                        toastr.clear();
                        if (data.success == "1") {
                            if (segments[2] == "navigation" || segments[2] == "online_campus_navigation" || segments[2] == "media") {
                                window.location.reload();
                            } else {
                                table.ajax.reload(null, false);
                                $('.loader').hide();
                                toastr.success(data.message);
                            }
                        }
                        else {
                            $('.loader').hide();
                            toastr.error(data.message);
                        }
                    }
                });
            }
            else if (v == false) {

            }
            $.prompt.close();
        }
    });
}

function deleteData(id, title, body) {
    var table = $("#data-table").DataTable();
    var url = baseUrl + segments[2] + "/destroy";
    if (title == "") {
        title = "Do you want to delete?";
    }
    if (body == "") {
        body = "If you select yes, " + segments[2].replace(/[\_]+/g, ' ') + " will be removed.";
    }
    $.prompt(body, {
        title: title,
        buttons: { "No": false, "Yes": true },
        focus: 1,
        submit: function (e, v, m, f) {
            if (v) {
                $('.loader').show();
                e.preventDefault();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': _token
                    },
                    type: "post",
                    url: url,
                    data: { id: id },
                    success: function (data) {
                        toastr.clear();
                        if (data.success == "1") {
                            if (segments[2] == "navigation" || segments[2] == "online_campus_navigation" || segments[2] == "media") {
                                window.location.reload();
                            } else {
                                table.ajax.reload(null, false);
                                $('.loader').hide();
                                toastr.success(data.message);
                            }
                        }
                        else {
                            $('.loader').hide();
                            toastr.error(data.message);
                        }
                    }
                });
            }
            $.prompt.close();
        }
    });
}


function convertTime24to12(timeString) {
    var hourEnd = timeString.indexOf(":");
    var H = +timeString.substr(0, hourEnd);
    var h = H % 12 || 12;
    var ampm = H < 12 ? "AM" : "PM";
    timeString = h + timeString.substr(hourEnd, 3) + ' ' + ampm;
    return timeString;
}

function convertTime12to24(time12h) {
    const [time, modifier] = time12h.split(' ');
    let [hours, minutes] = time.split(':');
    if (hours === '12') {
        hours = '00';
    }
    if (modifier === 'PM') {
        hours = parseInt(hours, 10) + 12;
    }
    return `${hours}:${minutes}`;
}

function createCookie(name, value, days) {
    var date, expires;
    if (days) {
        date = new Date();
        date.setDate(date.getDate()+days);
        expires = "; expires="+date.toUTCString();
    } else {
        expires = "";
    }
    document.cookie = name+"="+value+expires+"; path=/";
    console.log(name+"="+value+expires+"; path=/");
}

function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}
function eraseCookie(name) {
    document.cookie = name + '=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}

function setErrorPlacement(error, element)
{
    var elem = $(element);
    if (elem.hasClass("select2-hidden-accessible")) {
        error.insertAfter(element.parent().find('span').first());
    } else if (elem.hasClass("clsSimpleEditor") || elem.hasClass("clsFullEditor")) {
        // error.insertAfter(element.next());
        error.insertAfter(element.closest("div").find(".tox-tinymce"));
    } else if (element.is("input[type=radio]")) {
        error.insertAfter(element.closest(".radio-wrap"));
    } else if (element.is("input[type=checkbox]")) {
        error.insertAfter(element.closest(".radio-wrap"));
    } else if (element.is("input[type=file]")) {
        error.insertAfter($(".image_div"));
    } else if (elem.hasClass("inptp")) {
        error.insertAfter(element.parent());
    } else {
        error.insertAfter(element);
    }
}

function logout() {
    alert();
    $.prompt(" ", {
        title: "Do you really want to logout?",
        buttons: { "Yes": true, "No": false },
        submit: function (e, v, m, f) {
            if (v) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: baseUrl + "logout",
                    success: function (data) {
                        console.log(data);
                        if (data.success == "1") {
                            event.preventDefault();
                            document.getElementById('logout-form').submit();
                            location.reload();
                        } else {
                            location.reload();
                        }
                    },
                });
            }
        }
    });
}
