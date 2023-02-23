$(document).ready(function(){
    data_table();
    'use strict';
    $('.unit_type').on('click', function() {
        let val = $('input[name=unit_type]:checked').val();
        $('#type_of_building').removeAttr('hidden','hidden');
        if(val == 'Residential') {
            $('#type_of_building').children('div').remove();
            $('#type_of_building').append(`
            <div class="col-sm-9">
                <input type="radio" class="form-check-input rad type_of_building" name="type_of_building" value="flat">flat
                <input type="radio" class="form-check-input rad type_of_building" name="type_of_building" value="House/Villa">House/Villa
                <input type="radio" class="form-check-input rad type_of_building" name="type_of_building" value="plot">plot
            </div>
            `)
        } else if(val == 'Commercial') {
            $('#type_of_building').children('div').remove();
            $('#type_of_building').append(`
            <div class="col-sm-9">
                <input type="radio" class="form-check-input rad type_of_building" name="type_of_building" value="Office Space">Office Space
                <input type="radio" class="form-check-input rad type_of_building" name="type_of_building" value="Shop/Showroom">Shop/Showroom
                <input type="radio" class="form-check-input rad type_of_building" name="type_of_building" value="Commercial Land">Commercial Land
            </div>
            `)
        } else if(val == 'Other Property Type') {
            $('#type_of_building').children('div').remove();
            $('#type_of_building').append(`
            <div class="col-sm-9">
                <input type="radio" class="form-check-input rad type_of_building" name="type_of_building" value="Agricultural Land">Agricultural Land
                <input type="radio" class="form-check-input rad type_of_building" name="type_of_building" value="Farm House">Farm House
            </div>
            `)
        }
    });

    $('#type_of_building').on('click', function () {
        let val = $('input[name=type_of_building]:checked').val();
        let ar = ['plot', 'Office Space', 'Shop/Showroom', 'Commercial Land', 'Agricultural Land', 'Farm House']; 
        if(jQuery.inArray(val, ar) != '-1') {
            $('#unit_number').attr('hidden','hidden');
        } else {
            $('#unit_number').removeAttr('hidden');
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
            {data: 'project_name',name: 'project_name'},
            {data: 'unit_type',name: 'unit_type'},
            {data: 'size',name: 'size'},
            {data: 'price',name: 'price'},
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

function Delete(param1, param2) {
    var valu = confirm('Are you sure you want to delete!');
    if(valu == true) {
      $.ajax({
        headers: {
            'X-CSRF-Token': _token
        },
        url:baseUrl+segments[2]+"/delete-files",
        type: 'POST',
        data: {
          file_name : param1,
          id: param2,
        },
        dataType:'json',
        success: function () {
            $('#message').append('<div class="alert alert-danger">successfully deleted</div>');
            window.setInterval(window.location.reload(),2000);
        },
        error: function (xhr, status, error) {
            console.log(xhr.responseText);
        }
      })
    }
  }