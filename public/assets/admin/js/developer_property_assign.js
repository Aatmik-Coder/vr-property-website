$(document).ready(function(){
    // var url = window.location.href;
    // var url_name = url.split('/');
    // var nam = url_name['5'];

    // if(nam == 'agency'){
        $('#agency_id').multiselect({
            selectAll: true,
            search:true
        });
        $('#employee_id').multiselect({
            selectAll: true,
            search:true
        });
    // }
});