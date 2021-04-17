<?php
$cmsPage = $this->getCmsPage();
$option = $cmsPage->getStatusOption();
?>
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
<div class="container">
    <h2 align="center" class="display-4">Add/Update CMS Pages</h2>

        <form method="post" action="<?php echo $this->getUrl('save') ?>">
  
        <div class="row">
            <div class="col-lg-6">

                <label for="title" class="form-label">Title</label><br>
                <input type="text" class="form-control"  name="cmsPage[title]" value="<?php echo $cmsPage->title; ?>">

                <label for="identifier" class="form-label">Identifier</label><br>
                <input type="text" class="form-control"  name="cmsPage[identifier]" value="<?php echo $cmsPage->identifier; ?>">

                <label for="status" class="form-label">Status</label><br>
                <select name="cmsPage[status]">
                <?php foreach($option as $key=>$value){ ?>
                    <option value="<?php echo $key; ?>" <?php if($cmsPage->status == $key){echo "selected";} ?> ><?php echo $value; ?></option>
                <?php } ?>
                </select><br><br><br><br>
                <button type="submit" class="btn btn-success" value="submit">Submit</button>
    
            </div>

            <div class="col-lg-6">

                <label for="content" class="form-label">Content</label><br>
                <textarea class="form-control"  rows="20" name="cmsPage[content]" value="<?php echo $cmsPage->content;?>"></textarea>
                <script>
                        CKEDITOR.replace( 'cmsPage[content]');
                </script>
                

            </div>
        </div>

        </form>
        <div class="footer">
            <p>I am Queen!!!!</p>
        </div> 

</div>

