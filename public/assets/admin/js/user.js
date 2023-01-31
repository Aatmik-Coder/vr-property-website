$(document).ready(function(){
    data_table();
    'use strict';
});

var dtTable;
function data_table()
{
    $.fn.dataTable.ext.errMode = 'none';
    dtTable = $('#data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            headers: {
                'X-CSRF-Token': _token
            },
            url: baseUrl+segments[2]+"/ajax",
            type: "POST",
            complete: function (data) {
                $(".loader").hide();
            },
        },
        "order": [],
        columns: [
            {data: 'first_name',name: 'first_name'},
            {data: 'last_name',name: 'last_name'},
            {data: 'email',name: 'email'},
            {data: 'nick_name',name: 'nick_name'},
            {data: 'business_name',name: 'business_name'},
            {data: 'is_active',name: 'is_active',orderable: false},
            {data: 'action',name: 'action',orderable: false},
        ],
        

        oLanguage: {
            sSearch: "",
            sSearchPlaceholder: "Search",
            sEmptyTable: "No data found.",
            sProcessing: '<div class="loader"><span class="loader-image"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></span></div>'
        }
    });
    $('input[type=search]').addClass("form-control");
}
