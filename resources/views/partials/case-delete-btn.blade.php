<script src="{{ asset('js/bootbox.min.js') }}"></script>
<script type="application/javascript">
    $(document).ready(function() {
        $('#cases').on('click', '.delete', function () {
            let btn = this;
            let id = $(btn).attr('id');

            bootbox.confirm({
                title: "Delete Case?",
                message: "Do you really want to delete this record?",
                buttons: {
                    cancel: {
                        label: `<i class="fa fa-times"></i> Cancel`
                    },
                    confirm: {
                        label: `<i class="fa fa-check"></i> Confirm`
                    }
                },
                callback: function (result) {
                    let url = '{{ route("admin.cases.destroy",["case"=> ":id"]) }}';
                    url = url.replace(':id', id);
                    if(result){
                        $(btn).html(`<i class="fa fa-spinner fa-spin"></i> deleting...`);
                        // AJAX Request
                        $.ajax({
                            url: url,
                            type: 'POST',
                            data: {
                                '_token' : $('input[name="_token"]').val(),
                                _method: 'delete'
                            },
                            success: function(response){
                                var table = $('#cases').DataTable();
                                table.row($(btn).parents('tr')).remove().draw(false); //c
                                window.location.reload();
                            },
                            error: function (response) {
                                console.log("error "+ response.data);
                            }
                        });
                    }
                }
            });// command for delete all that row
        });
    } );
</script>
