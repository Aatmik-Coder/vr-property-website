$(document).ready(function(){
    data_table();
    'use strict';
});

function deleteData(url) {
    alert(url);
    if(confirm('Are you sure want to delete?'))
    {
        $.ajax({
            headers:{
                'X-CSRF-Token':_token
            },
            url:url,
            type:'DELETE',
            dataType:'json',
            success:function (result) {
                location.reload();
            }
        });
    }
}

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
            {data: 'id',name: 'id'},
            {data: 'name',name: 'name'},
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
