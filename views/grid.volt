<script>
    $(document).ready(function(){
        var grid = $("#grid-selection").bootgrid({
            ajax: true,
            url: "{{ url("blog/list") }}",
            selection: true,
            multiSelect: true,
            formatters: {
                "commands": function(column, row)
                {
                    return "<button type=\"button\" class=\"btn btn-sm btn-primary command-edit\" data-row-title=\""+row.title+"\" data-row-category=\""+row.category+"\" data-row-id=\"" + row.id + "\"><span class=\"fa fa-pencil\"></span></button> " +
                        "<button type=\"button\" class=\"btn btn-sm btn-primary command-delete\" data-row-id=\"" + row.id + "\"><span class=\"fa fa-trash-o\"></span></button>";
                }
            }
        }).on("loaded.rs.jquery.bootgrid", function()
        {
            $(this).find(".command-edit").off();
            $(this).find(".command-delete").off();
            $(this).find(".command-add").off();

            $(this).find(".command-edit").on("click", function(e)
            {
                myForm('edit',$(this));
                $("#myForm").ajaxForm({
                    url: '{{ url("blog/edit") }}',
                    type: 'post',
                    success: function(data) {
                        myAlert(data);
                        $("#grid-selection").bootgrid("reload");
                        setTimeout(function(){
                            $('#myModal').modal('hide')
                        }, 10000);
                    }
                });

            }).end().find(".command-delete").on("click", function(e)
            {
                $.get( "{{ url('blog/delete/') }}"+ $(this).data("row-id"), function( data ) {
                    myAlert(data);
                    $("#grid-selection").bootgrid("reload");
                });

            });
        });

        $(".actionBar").append(" <div class='btn btn-primary' id='create' class='command-add'><span class=\"fa fa-plus-square-o\"></span> New Page</div>");

        $("#create").on('click',function (e) {
            myForm('create',e);
            $("#save").on('click',function(e){
                $("#myForm").ajaxForm({
                    url: '{{ url("blog/create") }}',
                    type: 'post',
                    success: function(data) {
                        myAlert(data);
                        grid.bootgrid("reload");
                    }
                });
            });
        });

        function myForm(status,e) {
            $('#myForm')[0].reset();
            if(status == 'edit') {
                $('#myModal .modal-title').html('Edit page '+e.data("row-title"));
                $.getJSON("{{ url('blog/get/?id=') }}" + e.data("row-id"), function (data) {
                    $('#hidden_id').val(data.id);
                    $('#title').val(data.title);
                    $('#published').val(data.publish);
                });

            }else{
                $('#myModal .modal-title').html('Create New page ');
            }

            $('#myModal').modal('show');

        }

        function myAlert(e) {
            if(e.alert == "sukses"){
                toastr.options.onHidden = function() { $('#myModal').modal('hide');};
                toastr.error(e.msg, e.alert);
                toastr.options.timeOut = 15;
                toastr.options.extendedTimeOut = 30;
            }else{
                toastr.error(e.msg, e.alert);
                toastr.options.timeOut = 15;
                toastr.options.extendedTimeOut = 30;
            }
        }
    });
</script>