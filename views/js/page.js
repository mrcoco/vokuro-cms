 $(document).ready(function(){
    $('textarea').trumbowyg();
    var grid = $("#grid-selection").bootgrid({
        ajax: true,
        url: "page/list",
        selection: true,
        multiSelect: true,
        templates: {
            header:"<div id=\"{{ctx.id}}\" class=\"{{css.header}}\"><div class=\"row\"><div class=\"col-sm-6 actionBar\"><div class=\"{{css.search}}\"></div></div><div class=\"col-sm-6\"><div class=\"{{css.actions}}\"></div> <div class='btn btn-primary' id='create' class='command-add'> <span class=\"fa fa-plus-square-o\"></span> New Page</div></div></div></div>",
        },
        formatters: {
            "published": function(column, row)
            {
                if(row.publish == 1){
                    return "Yes";
                }else{
                    return "No";
                }
            },
            "commands": function(column, row)
            {
                return "<button type=\"button\" class=\"btn btn-sm btn-primary command-edit\" data-row-title=\""+row.title+"\" data-row-category=\""+row.categories_id+"\" data-row-id=\"" + row.id + "\"><span class=\"fa fa-pencil\"></span></button> " +
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
                url: 'page/edit',
                type: 'post',
                success: function(data) {
                    myAlert(data);
                    $("#grid-selection").bootgrid("reload");
                    setTimeout(function(){
                        $('#myModal').modal('hide')
                    }, 5000);
                }
            });

        }).end().find(".command-delete").on("click", function(e)
        {
            $.get( "page/delete/"+ $(this).data("row-id"), function( data ) {
                myAlert(data);
                $("#grid-selection").bootgrid("reload");
            });

        });
    });

    $("#create").on('click',function (e) {
        myForm('create',e);
        //$("#save").on('click',function(e){
            var cat_val = $("#category").val();
            $("#myForm").ajaxForm({
                url: 'page/create',
                type: 'post',
                beforeSubmit:  function(data) {
                    if(cat_val == 0){
                        var mesg = { alert : "error" , title : "Error no Category", _id : "cr1", msg: "no category Selected"};
                        myAlert(mesg);
                        $("#category").css("border-color","rgb(185, 74, 72)");
                        $("#lab_cat").append(" <span style='color: rgb(185, 74, 72);'>This is a required field</span>");
                        return false;
                    }
                },
                success: function(data) {
                    myAlert(data);
                    grid.bootgrid("reload");
                    setTimeout(function(){
                        $('#myModal').modal('hide');
                    }, 5000);
                }
            });
        //});
    });

    function myForm(status,e) {
        $('#myForm')[0].reset();
        if(status == 'edit') {
            $('#myModal .modal-title').html('Edit page '+e.data("row-title"));
            $.getJSON("page/get/?id=" + e.data("row-id"), function (data) {
                //$('#summernote').text("");
                $('#hidden_id').val(data.id);
                $('#title').val(data.title);
                $('#published').val(data.publish);
                $('#summernote').trumbowyg('html',data.content);
            });
            selectBox('edit', e);
        }else{
            $('#myModal .modal-title').html('Create New page ');
            selectBox('create',e);
            $('#summernote').trumbowyg('html',"");
        }
        $('#myModal').modal('show');
    }

    function selectBox(status,e) {
        $('#category option').each(function(){
            if ($('#category option[value="'+$(this).val()+'"]').length) $(this).remove();
        });

        $.get( "page/categories", function( data ) {
            $("#category").append( "<option value='0'>-- Category --</option>");
            $.each(data, function (index, element) {
                $("#category").append( "<option value='"+element.id+"'>"+element.name+"</option>");
            });
            if(status == 'edit'){
                $("#category").val(e.data("row-category"));
            }
        }, "json" );
    }

    function myAlert(e)
    {
        var mesg= [];
        mesg["alert"] = e.alert;
        mesg["title"] = e.msg;
        mesg["msg"] = "#Page "+e._id+" "+e.msg;
        notif_show(mesg);
    }

});