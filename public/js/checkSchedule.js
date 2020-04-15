function checkSchedule(start_time, end_time, venue, url, token) {
    if((start_time != null) && new Date(start_time) > new Date(end_time)){

        $("#start_time_errors").text("start date time  cannot be greater than end date time");
        $("#start_time_errors").css({'display':'block'});
        $('#form').attr('onsubmit','return false;');

    }
    else if (start_time != null){

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                '_token' : token,
                'start_time': start_time,
                'end_time': end_time,
                'venue': venue
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response){

                $("#start_time_errors").text("");
                $("#start_time_errors").css({'display':'none'});

                if(response.status){

                    $("#end_time_errors").text("Schedule for this date already exists");
                    $("#end_time_errors").css({'display':'block'});
                    $('#form').attr('onsubmit','return false;');
                }else{
                    $("#end_time_errors").text("");
                    $("#end_time_errors").css({'display':'none'});
                    $('#form').attr('onsubmit','return true;');
                }

            },
            error: function (response) {
            }
        });
    }
}
