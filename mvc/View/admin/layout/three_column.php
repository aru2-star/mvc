<!DOCTYPE html>
<html>
<head>
    <?php echo $this->getBlock('Block\Core\Layout\Head')->toHtml();?>
</head>
<body>

<table width="100%">
    <tr>
        <td colspan="3"><?php echo $this->getHeader()->toHtml(); ?>
        </td>
    </tr>
    <tr>
        <td colspan="3"><?php $message = $this->createBlock('Block\Core\Layout\Message');
                //echo $message->toHtml();?></td>
    </tr>
    <tr>
        <td height="500px" width="30px"><?php echo $this->getLeft()->toHtml(); ?></td>
        <td width="500px"><?php echo $this->getContent()->toHtml(); ?></td>
        <td width="30px">Right</td>
    </tr>
    <tr>
        <td height ="100px" colspan="3"><?php echo $this->getFooter()->toHtml(); ?></td>
    </tr>
</table>
</body>
</html>