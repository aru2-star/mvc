<!-- <table border="1" width="100%" height="100%">

    <tr>
        <td colspan="3">
            
        </td>
    </tr>
    <tr>
        <td>2</td>
        <td>
            
        </td>
        <td>4</td>
    </tr>
    <tr>
        <td colspan="3">
            
        </td>
    </tr>

</table> -->


<?php echo $this->getChild('header')->toHtml(); ?>


<div class="d-flex" style="height: 100%;">
    <div class="left" style="width:30%;height:100vh">
        <?php echo $this->getChild('left')->toHtml(); ?>
    </div>
    <div class=" content" style="width:70%;height:100vh">
        <?php echo $this->getChild('content')->toHtml(); ?>
    </div>
</div>


<?php echo $this->getChild('footer')->toHtml(); ?>