<html>
<head>
    <title>Appliication</title>
    <meta charset="utf-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <script type="text/javascript" src="<?php echo $this->baseUrl('skin/admin/js/jquery-3.5.1.slim.js');?>"></script>
    <script type="text/javascript" src="<?php echo $this->baseUrl('skin/admin/js/mage.js');?>"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <style>
        .footer {
        left: 0;
        bottom: 0;
        width: 100%;
        background-color: grey;
        color: black;
        text-align: center;
        font-weight:bold;
        padding:20px;
        font-size:25px;
        }
</style>    
</head>
<body>

<table border=1 width="100%">
    <tbody>
        <tr>
            <td height="100px">
                <?php 
                    $this->getChild('header')->toHtml();
                ?></td>
        </tr>
        <tr>
            <td height="250px">
                <?php
                    $this->createBlock('Block\Core\Layout\Message')->toHtml(); 
                    $this->getChild('content')->toHtml();
                ?>
            </td>
        </tr>
        <tr>
            <td height="100px">
                <?php 
                    $this->getChild('footer')->toHtml();
                ?>
            </td>
        </tr>
    </tbody>
</table>