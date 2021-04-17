<?php 
$media = $this->getMedia();
?>

<h2 align="center" class="display-5">Product Media</h2><br>
<form action="<?php echo $this->getUrl('productMedia'); ?>" enctype="multipart/form-data" method="POST">

<input type="submit" name="update" value="Update" style="margin-left:20px;" class="btn btn-success">
<input type="submit" name="remove" value="Remove" style="margin-left:20px;" class="btn btn-success"><br><br>

    <table border="2" style="width:100%">
        <tr align="center" class="table table-striped table-hover">
            <th>Image</th>
            <th>Label</th>
            <th>Small</th>
            <th>Thumb</th>
            <th>Base</th>
            <th>Gallery</th>
            <th>Remove</th>
        </tr>
        <?php if(!$media): ?>
            <tr>
                <td colspan="7">No MEdia Found!!!</td>
            </tr>
        <?php else : ?>     
        <?php foreach($media as $key=>$value){ ?>
            <tr align="center">
                <td><image src="<?php echo $value->image; ?>" height="100" width="100"></td>
                <td><input type="text" name="label[<?php echo $value->mediaId ?>]" value="<?php echo $value->label;?>"></td>		
                <td><input type="radio" name="small" value="<?php echo $value->mediaId ?>" <?php if($value->small)echo "checked";?>></td>
                <td><input type="radio" name="thumb" value="<?php echo $value->mediaId ?>" <?php if($value->thumb)echo "checked";?>></td>
                <td><input type="radio" name="base" value="<?php echo $value->mediaId ?>" <?php if($value->base)echo "checked";?>></td>
                <td><input type="checkbox" name="gallery[<?php echo $value->mediaId ?>]" <?php if($value->gallery)echo "checked";?>></td>
                <td><input type="checkbox" name="delete[<?php echo $value->mediaId ?>]"></td>
            </tr>
        <?php } endif; ?>
    </table><br>
    <input type="file" name="imagefile">
    <input type="submit" name="image" value="Upload" class="btn btn-success">
</form>