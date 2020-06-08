<script src="{{ asset('js/bootbox.min.js') }}"></script>
<script type="application/javascript">
    $(document).ready(function() {
        $('#cases').on('click', '.delete', function () {

            $(this).attr('disabled', true);
            var table = $('#cases').DataTable();
            table.row($(this).parents('tr')).remove().draw(false); //c
            let id = $(this).attr('id');

            bootbox.confirm("Do you really want to delete record?", function(result) {
                let url = '{{ route("admin.cases.destroy",["case"=> ":id"]) }}';
                url = url.replace(':id', id);
                console.log('url = '+url);
                console.log($('input[name="_token"]').val());
                if(result){
                    // AJAX Request
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {
                            '_token' : $('input[name="_token"]').val(),
                            _method: 'delete'
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response){
                            console.log(response.status);
                            window.location.reload();
                           // $('#status_alert').find('strong.status').html(''+response.status);
                        },
                        error: function (response) {
                            console.log("error "+ response.data);
                        }
                    });
                }

            });// command for delete all that row
        });
    } );
</script>
