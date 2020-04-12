<script src="{{ asset('js/bootbox.min.js') }}"></script>
<script type="application/javascript">
    $(document).ready(function() {
        $('.delete').click(function(){
            var el = this;

            // Delete id
            let id = $(this).attr('id');
            console.log('id = '+id);
            // Confirm box
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
                            console.log("Successfully deleted");
                            window.location.reload();
                        },
                        error: function (response) {
                            console.log("error "+ response.data);
                        }
                    });
                }

            });

        });
    } );
</script>
