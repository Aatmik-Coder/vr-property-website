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
            url: "/agency/properties-assigned/ajax",
            type: "POST",
            complete: function (data) {
                $(".loader").hide();
            },
        },
        "order": [],
        columns: [
            {data: 'country_id',name: 'country_id'},
            {data: 'state_id',name: 'state_id'},
            {data: 'city_id',name: 'city_id'},
            {data: 'project_name',name: 'project_name'},
            {data: 'unit_type',name: 'unit_type'},
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