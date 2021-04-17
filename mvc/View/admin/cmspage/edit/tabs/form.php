<?php
$cmsPage = $this->getTableRow();
$option = $cmsPage->getStatusOption();
?>
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
<div class="container">
    <h2 align="center" class="display-4">Add/Update CMS Pages</h2>

        <form method="post" action="<?php echo $this->getUrl('save') ?>">
  
        <div class="row">
            <div class="col-md-6">

                <label for="title" class="form-control">Title</label><br>
                <input type="text" class="form-control"  name="cmsPage[title]" value="<?php echo $cmsPage->title; ?>">

                <label for="identifier" class="form-control">Identifier</label><br>
                <input type="text" class="form-control"  name="cmsPage[identifier]" value="<?php echo $cmsPage->identifier; ?>">

                <label for="status" class="form-control">Status</label><br>
                <select name="cmsPage[status]">
                <?php foreach($option as $key=>$value){ ?>
                    <option value="<?php echo $key; ?>" <?php if($cmsPage->status == $key){echo "selected";} ?> ><?php echo $value; ?></option>
                <?php } ?>
                </select><br><br><br><br>
                <button type="submit" class="btn btn-success" value="submit">Submit</button>
    
            </div>

            <div class="col-md-6">

                <label for="content" class="form-control">Content</label><br>
                <textarea class="form-control"  rows="20" name="cmsPage[content]" value="<?php echo $cmsPage->content;?>"></textarea>
                <script>
                        CKEDITOR.replace( 'cmsPage[content]');
                </script>
                

            </div>
        </div>
        </form>
</div>