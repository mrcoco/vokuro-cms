$(document).ready(function(){
    var grid = $("#grid-selection").bootgrid({
        ajax: true,
        url: "category/list",
        selection: true,
        multiSelect: true,
        templates: {
            header:"<div id=\"{{ctx.id}}\" class=\"{{css.header}}\"><div class=\"row\"><div class=\"col-sm-6 actionBar\"><div class=\"{{css.search}}\"></div></div><div class=\"col-sm-6\"><div class=\"{{css.actions}}\"></div> <div class='btn btn-primary' id='create' class='command-add'> <span class=\"fa fa-plus-square-o\"></span> New Category</div></div></div></div>",
        },
        formatters: {
            "commands": function(column, row)
            {
                return "<button type=\"button\" class=\"btn btn-sm btn-primary command-edit\"  data-row-name=\""+row.name+"\" data-row-id=\"" + row.id + "\"><span class=\"fa fa-pencil\"></span></button> " +
                        "<button type=\"button\" class=\"btn btn-sm btn-primary command-delete\" data-row-id=\"" + row.id + "\"><span class=\"fa fa-trash-o\"></span></button>";
            }
        }
    }).on("loaded.rs.jquery.bootgrid", function()
    {
        $(this).find(".command-edit").off();
        $(this).find(".command-delete").off();
        /* Executes after data is loaded and rendered */
        $(this).find(".command-edit").on("click", function(e)
        {
            $('#myModal .modal-title').html('Edit Category '+$(this).data("row-name"));
            $('#hidden_id').val($(this).data("row-id"));
            $('#title').val($(this).data("row-name"));
            $('#result-form').html("");
            $('#myModal').modal('show');
            $("#myForm").ajaxForm({
                url: 'category/edit',
                type: 'post',
                success: function(data) {
                    myAlert(data);
                    $("#grid-selection").bootgrid("reload");
                }
            });

        }).end().find(".command-delete").on("click", function(e)
        {
            $.get( "category/delete/"+ $(this).data("row-id"), function( data ) {
                myAlert(data);
                $("#grid-selection").bootgrid("reload");
            });
        });
    });

    $("#create").on('click',function (e) {
        $('#myModal .modal-title').html('Create New Category ');
        $('#result-form').html("");
        $('.modal-body').find('textarea,input').val('');
        $('#myModal').modal('show');
        $("#myForm").ajaxForm({
            url: 'category/create',
            type: 'post',
            success: function(data) {
                myAlert(data);
                grid.bootgrid("reload");
            }
        });
    });

    function myAlert(e)
    {
        var mesg= [];
        mesg["alert"] = e.alert;
        mesg["title"] = e.msg;
        mesg["msg"] = "#Category "+e._id+" "+e.msg;
        notif_show(mesg);
    }
});