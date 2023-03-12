$(document).ready(function(){
    // var country;
    $('#country_id').on('change', function() {
        data_table();
    });
    $('#state_id').on('change', function() {
        data_table();
    });
    $('#city_id').on('change',function() {
        data_table();
    });
    $('#project_name').on('change', function() {
        data_table();
    });
    $('#unit_type').on('change',function() {
        data_table();
    });
    data_table();
    upcoming_meeting_table();
    'use strict';
});

var dtTable;
var dtTable2;
function data_table()
{
    console.log($('#state_id').val());
    $.fn.dataTable.ext.errMode = 'none';
    if (dtTable) {
        dtTable.destroy();
      }
    dtTable = $('#data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            headers: {
                'X-CSRF-Token': _token
            },
            url: "/employee/properties-assigned/ajax",
            type: "POST",
            beforeSend: function() {
                console.log('beforeSend');
              },
            data:function(d)
                {
                    d.country=$('#country_id').val(),
                    d.state=$('#state_id').val(),
                    d.city=$('#city_id').val(),
                    d.project_name=$('#project_name').val(),
                    d.unit_type = $('#unit_type').val()
                },
            complete: function (data) {
                $(".loader").hide();
            },
        },
        
          success: function(response) {
            console.log('success');
          },
          error: function(xhr, status, error) {
            console.log('error');
          },
        "order": [],
        columns: [
            {data: 'country_id',name: 'country_id'},
            {data: 'state_id',name: 'state_id'},
            {data: 'city_id',name: 'city_id'},
            {data: 'project_name',name: 'project_name'},
            {data: 'unit_type',name: 'unit_type'},
            {data: 'action',name: 'action'},
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

function upcoming_meeting_table() {
    $.fn.dataTable.ext.errMode = "none";
    if(dtTable2) {
        dtTable2.destroy();
    }
    dtTable2 = $('#data-table-upcoming-meeting').DataTable({
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
            {data:'project_name', name: 'project_name'},
            {data:'demo_date', name: 'demo_date'},
            {data:'demo_time', name: 'demo_time'},
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