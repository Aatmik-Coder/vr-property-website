$(document).ready(function(){
    data_table();
    'use strict';
});

var dtTable;
function data_table()
{
    $.fn.dataTable.ext.errMode = 'none';
    if (dtTable) {
        dtTable.destroy();
      }
    var url = window.location.href;
    var url_name = url.split('/');
    var nam = url_name['5'];
    
    if(nam == 'agency'){
        data_name = "";
        data_name = 'agency_name';
    } 
    else if(nam == 'employee') {
        data_name = "";
        data_name = 'person_name';
    }

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
            {data: 'project_name',name: 'project_name'},
            {data: data_name,name: data_name},
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