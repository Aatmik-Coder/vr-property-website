$(document).ready(function(){
    data_table();
    'use strict';

    $('#role_id').on('change', function() {
        let roleName = $(this).find(':selected').text();
        if(roleName != 'Super Admin' && roleName != 'Select') {
            $('#type_name').children('label').remove();
            $('#type_name').children('div').remove();
            $('#type_name').append(`
            <label class="col-sm-3 form-control-label">${roleName} name</label>
            <div class="col-sm-9">
                <input id="${roleName}_name" name="${roleName}_name" type="text" class="form-control" placeholder="enter developer name">
            </div>
            `);
        } else {
            $('#type_name').children('label').remove();
            $('#type_name').children('div').remove();
        }
    });
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
            {data: 'id',name: 'id'},
            {data: 'role_id', name:'role_id'},
            // {data: 'person_name',name: 'person_name'},
            // {data: 'person_email',name: 'person_email'},
            // {data: 'person_mobile_number',name: 'person_mobile_number'},
            // {data: 'action',name: 'action',orderable: false},
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
