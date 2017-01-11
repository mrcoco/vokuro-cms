<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous"><?php echo $this->tag->linkTo(["pages", "Go Back"]) ?></li>
        </ul>
    </nav>
</div>

<div class="page-header">
    <h1>
        Create pages
    </h1>
</div>

<?php echo $this->getContent(); ?>

<?php
    echo $this->tag->form(
        [
            "admin/pages/create",
            "autocomplete" => "off",
            "class" => "form-horizontal"
        ]
    );
?>

<div class="form-group">
    <label for="fieldTitle" class="col-sm-2 control-label">Title</label>
    <div class="col-sm-10">
        <?php echo $this->tag->textField(["title", "size" => 30, "class" => "form-control", "id" => "fieldTitle"]) ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldSlug" class="col-sm-2 control-label">Slug</label>
    <div class="col-sm-10">
        <?php echo $this->tag->textField(["slug", "size" => 30, "class" => "form-control", "id" => "fieldSlug"]) ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldContent" class="col-sm-2 control-label">Content</label>
    <div class="col-sm-10">
        <?php echo $this->tag->textArea(["content", "cols" => 30, "rows" => 4, "class" => "form-control", "id" => "fieldContent"]) ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldCreated" class="col-sm-2 control-label">Created</label>
    <div class="col-sm-10">
        <?php echo $this->tag->textField(["created", "size" => 30, "class" => "form-control", "id" => "fieldCreated"]) ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldUsersId" class="col-sm-2 control-label">Users</label>
    <div class="col-sm-10">
        <?php echo $this->tag->textField(["users_id", "type" => "number", "class" => "form-control", "id" => "fieldUsersId"]) ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldCategoriesId" class="col-sm-2 control-label">Categories</label>
    <div class="col-sm-10">
        <?php echo $this->tag->textField(["categories_id", "type" => "number", "class" => "form-control", "id" => "fieldCategoriesId"]) ?>
    </div>
</div>


<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <?php echo $this->tag->submitButton(["Save", "class" => "btn btn-default"]) ?>
    </div>
</div>

<?php echo $this->tag->endForm(); ?>
