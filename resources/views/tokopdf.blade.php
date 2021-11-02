<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="barcode" style="text-align:center;width:143px;height:63px;padding-top: 5px;margin-left:-35px;margin-right:44px;font-size:12px;margin-top:-18px">                   
<?php
                             $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                             echo '<img style="width: 125px;height:25px;" src="data:image/png;base64,' . base64_encode($generator->getBarcode($id, $generator::TYPE_CODE_128)) . '">';                                    
                             echo '<br>';
                             echo $id;
                            ?>
    </div>
</body>
</html>