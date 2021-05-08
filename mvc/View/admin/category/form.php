<?php
include 'mainHeader.php'; 
?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <div class="container m-5">
        <section>
            <h4 class="text-muted text-weight-bold">Add Category</h4>
            <form action="<?php echo $this->getUrl('save')?>" method="post">
                    <div class="form-group">
                                    <label>ID</label>
                                    <input type="text" name="cid" id="cid" class="form-control" placeholder="auto" disabled>
                                </div>
                    
                    <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="category[name]" id="catname" class="form-control" placeholder="Enter Category Name">
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <input type="text" name="category[description]" id="catdesc" class="form-control" placeholder="Enter Category Description">   
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="category[status]" id="catstatus" class="form-control">
                                        <option value="enable">Enable</option>
                                        <option value="disable">Disable</option> 
                                    </select>  
                                </div>
                                <div class="form-group">
                            <input type="submit" class="btn btn-success" name="save"  id="save" value="Save"> 
                            <button type="button" class="btn btn-danger" >Close</button>
                        </div>
                        </div>
                </form>
        </section>
    </div>
</body>
</html>