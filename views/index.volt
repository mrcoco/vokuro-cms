<table id="grid-selection" class="table table-condensed table-hover table-striped">
    <thead>
    <tr>
        <th data-column-id="no" data-type="numeric" data-width="5%" data-sortable="false">no</th>
        <th data-column-id="title" data-sortable="false">Title</th>
        {#<th data-column-id="slug" data-sortable="false">Slug</th>#}
        <th data-column-id="content" data-width="35%" data-sortable="false">Content</th>
        <th data-column-id="status" data-sortable="false">Status</th>
        <th data-column-id="created" data-order="desc">Created</th>
        <!--<th data-column-id="updated" data-order="desc">Updated</th> -->
        <th data-column-id="commands" data-formatter="commands" data-sortable="false">Action</th>
    </tr>
    </thead>
</table>
<div id="myModal" class="modal fade modal-wide" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Modal title</h4>
            </div>
            <div class="modal-body">
                <div id="result-form"></div>
                <form id="myForm" method="post" enctype="multipart/form-data">

                    <div class="form-group" >
                        <label>Title</label>
                        <input class="form-control" name="hidden_id" id="hidden_id" type="hidden" >
                        <input class="form-control" name="title" id="title" data-validation="required">
                    </div>

                    <div class="form-group" >
                        <label>Content</label>
                        <textarea id="summernote" name="content" class="form-control col-xs-12 summernote" rows="7"></textarea>
                    </div>

                    <div class="form-group" >
                        <div class="row">
                            <div class="col-xs-3 col-xs-offset-9">
                                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i>  close</button>
                                <button type="submit" name="save" class="btn btn-primary" id="save"><i class="fa fa-save"></i>  Save </button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                {#<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>#}
                {#<button type="submit" class="btn btn-primary" id="save">Save changes</button>#}
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->