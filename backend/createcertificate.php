<?php
function drawName($nameFont,$nameFontSize,$nameTextColor,$alignName)
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
    return $drawName;
}

function drawReg($regFont,$regFontSize,$regTextColor,$alignReg)
{
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
    return $drawRegNumber;
}

function drawOnImage($regNumber, $name, $certificate, $regXCoordinate, $regYCoordinate, $nameXCoordinate, $nameYCoordinate, $saveAsName, $drawRegNumber, $drawName, $drawFor=false)
{
    $certificate = new \Imagick("../images/$certificate");
    $certificate->setImageFormat('png');
    $certificate->annotateImage($drawName,$nameXCoordinate, $nameYCoordinate, 0, $name);
    $certificate->annotateImage($drawRegNumber,$regXCoordinate, $regYCoordinate, 0, $regNumber);
    if($drawFor==false)
        $certificate->writeImage( "../temp/$saveAsName.png" );
    else
        $certificate->writeImage("certificates/$saveAsName.png");
}

?>