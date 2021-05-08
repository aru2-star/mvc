<!DOCTYPE html>
<html>
<head>
    <?php echo $this->getBlock('Block\Core\Layout\Head')->toHtml();?>
</head>
<body>
<table width="100%">
    <tr>
        <td colspan="3"><?php echo $this->getHeader()->toHtml(); ?></td>
    </tr>
    <tr>
        <td>
            <?php $message = $this->getBlock('Block\Core\Layout\Message');?>
            <?php echo $this->getContent()->toHtml(); ?>
        </td>
    </tr>
    <tr>
        <td height ="100px" colspan="3"><b><center><?php echo $this->getFooter()->toHtml(); ?></center></b></td>
    </tr>
</table>
</body>
</html>
