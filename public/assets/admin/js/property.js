$(document).ready(function(){
    $('.unit_type').on('click', function() {
        let val = $('input[name=unit_type]:checked').val();
        $('#type_of_building').removeAttr('hidden','hidden');
        if(val == 'Residential') {
            $('#type_of_building').children('div').remove();
            $('#type_of_building').append(`
            <div class="col-sm-9">
                <input type="radio" class="form-control-input rad type_of_building" name="type_of_building" value="flat">flat
                <input type="radio" class="form-control-input rad type_of_building" name="type_of_building" value="House/Villa">House/Villa
                <input type="radio" class="form-control-input rad type_of_building" name="type_of_building" value="plot">plot
            </div>
            `)
        } else if(val == 'Commercial') {
            $('#type_of_building').children('div').remove();
            $('#type_of_building').append(`
            <div class="col-sm-9">
                <input type="radio" class="form-control-input rad type_of_building" name="type_of_building" value="Office Space">Office Space
                <input type="radio" class="form-control-input rad type_of_building" name="type_of_building" value="Shop/Showroom">Shop/Showroom
                <input type="radio" class="form-control-input rad type_of_building" name="type_of_building" value="Commercial Land">Commercial Land
            </div>
            `)
        } else if(val == 'Other Property Type') {
            $('#type_of_building').children('div').remove();
            $('#type_of_building').append(`
            <div class="col-sm-9">
                <input type="radio" class="form-control-input rad type_of_building" name="type_of_building" value="Agricultural Land">Agricultural Land
                <input type="radio" class="form-control-input rad type_of_building" name="type_of_building" value="Farm House">Farm House
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