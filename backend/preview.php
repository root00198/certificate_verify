<?php
function deleteBulk()
{   
    //echo"asdasd";
    $files = glob('../temp/images/*'); //get all file names
    foreach($files as $file){
        if(is_file($file)){
            //echo($file);
            unlink($file); //delete file
        }
    }
}
function drawOnImage($regNumber, $name, $certificate, $regXCoordinate, $regYCoordinate, $nameXCoordinate, $nameYCoordinate, $regFont, $nameFont, $regTextColor, $nameTextColor, $regFontSize, $nameFontSize, $alignReg, $alignName,$saveAsName)
{
    $drawName = new \ImagickDraw();
    $drawName->setFont("../fonts/$nameFont");
    $drawName->setFontSize($nameFontSize);
    $drawName->setStrokeAntialias(true);
    $drawName->setTextAntialias(true);
    $drawName->setFillColor("$nameTextColor");
    $drawName->setGravity(Imagick::GRAVITY_NORTHWEST);
    switch($alignName)
    {
        case "CENTER" : $drawName->setTextAlignment(Imagick::ALIGN_CENTER);break;
        case "LEFT" : $drawName->setTextAlignment(Imagick::ALIGN_LEFT);break;
        case "RIGHT" : $drawName->setTextAlignment(Imagick::ALIGN_RIGHT);break;
    }

    $drawRegNumber = new \ImagickDraw();
    $drawRegNumber->setFont("../fonts/$regFont");
    $drawRegNumber->setFontSize($regFontSize);
    $drawRegNumber->setStrokeAntialias(true);
    $drawRegNumber->setTextAntialias(true);
    $drawRegNumber->setFillColor("$regTextColor");
    $drawRegNumber->setGravity(Imagick::GRAVITY_NORTHWEST);
    switch($alignReg)
    {
        case "CENTER" : $drawRegNumber->setTextAlignment(Imagick::ALIGN_CENTER);break;
        case "LEFT" : $drawRegNumber->setTextAlignment(Imagick::ALIGN_LEFT);break;
        case "RIGHT" : $drawRegNumber->setTextAlignment(Imagick::ALIGN_RIGHT);break;
    }

    $certificate = new \Imagick("../temp/images/".$certificate);
    $certificate->setImageFormat('png');
    $certificate->annotateImage($drawName,$nameXCoordinate, $nameYCoordinate, 0, $name);
    $certificate->annotateImage($drawRegNumber,$regXCoordinate, $regYCoordinate, 0, $regNumber);
    $certificate->writeImage( "../temp/images/$saveAsName.png" );
}
deleteBulk();
date_default_timezone_set("Asia/Kolkata");
$date = date('Y-m-d')." ".date("H:i:s");

$fileRename = $date;
$fileType = pathinfo($_FILES["myimage"]["name"],PATHINFO_EXTENSION);
$targetDir = "../temp/images/";
$_FILES["myimage"]["name"] = $fileRename.".".$fileType;
$fileName = basename($_FILES["myimage"]["name"]);
$targetFilePath = $targetDir . $fileName;
move_uploaded_file($_FILES["myimage"]["tmp_name"], $targetFilePath);

$certificate ="$fileRename.$fileType";
$name = $_POST["name"];
$regNumber = $_POST["registration"];
drawOnImage($regNumber,$name,$certificate,$_POST["regXCoordinate"],$_POST["regYCoordinate"],$_POST["nameXCoordinate"],$_POST["nameYCoordinate"],$_POST["regFont"],$_POST["nameFont"],$_POST["regTextColor"],$_POST["nameTextColor"],$_POST["regFontSize"],$_POST["nameFontSize"],$_POST["alignReg"],$_POST["alignName"],md5($fileRename));

$var = md5($fileRename);
echo ("https://whataftercollege.com/certificate_verify/temp/images/$var.png");

?>