$('document').ready(function() {
    $('#country_id').on('change', function () {
        let val =  this.value;
        $('#state_id').html('');
        $.ajax({
            headers:{
                'X-CSRF-TOKEN' : _token
            },
            url:'/fetch-states',
            type:'POST',
            data:{
                country_id:val,
            },
            dataType:'json',
            success: function (result) {
                $('#state_id').html('<option selected value="">Select state</option>');
                $.each(result.states, function (key, value) {
                    $('#state_id').append(`<option value=${value.id}>${value.name}</option>`);
                });
            }
        });
    });

    $('#state_id').on('change', function() {
        let val = this.value;
        $('#city_id').html('');
        $.ajax({
            headers:{
                'X-CSRF-TOKEN':_token
            },
            url:'/fetch-cities',
            type:'POST',
            data:{
                state_id:val,
            },
            dataType:'json',
            success:function(result) {
                $('#city_id').html(`<option selected value="">Select city</option>`);
                $.each(result.cities, function(key, value) {
                    $('#city_id').append(`<option value=${value.id}>${value.name}</option>`)
                })
            }
        });
    });

    // $('#agency_id').multiselect({
    //     selectAll: true,
    //     search:true
    // });

    // $('#employee_id').multiselect({
    //     selectAll: true,
    //     search:true
    // });
});