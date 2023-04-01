$(document).ready(function(){
    upcoming_meeting_table();
    'use strict';
});

var dtTable;
function upcoming_meeting_table() {
    $.fn.dataTable.ext.errMode = "none";
    alert("hello");
    dtTable = $('#data-table-upcoming-meeting').DataTable({
        processing: true,
        serverside: true,
        ajax:{
            headers:{
                'X-CSRF-TOKEN': _token
            },
            url: "/employee/upcoming-meeting/ajax",
            type: "POST",
            complete: function() {
                $(".loader").hide();
            },
        },
        "order":[],
        columns:[
            {data:'name', name: 'name'},
            {data:'email', name: 'email'},
            {data:'phone_number', name: 'phone_number'},
        ],
        oLanguage:{
            sSearch:"",
            sSearchPlaceholder: "Search",
            sEmptyTable: "No data found.",
            sProcessing: '<div class="loader"><span class="loader-image"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></span></div',
        }
    });
    $('input[type=search]').addClass("form-control");
}