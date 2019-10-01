<?php

$regID = $_POST["regID"];
$mailto = $_POST["mailto"];

if(file_exists('certificates/'.$regID.'.png'))
    $image = 'certificates/'.$regID.'.png';
else
{
    require("../backend/conn.php");
    $sql = "SELECT * from student where regNumber=\"$regID\"";
    $result = $conn->query($sql);
    if($result->num_rows==0)
    {
        echo "Failed";
        die();
    }
    $rows = $result->fetch_assoc();
    $certificateID = $rows["certificateID"];
    $sql = "SELECT * from certificate where certificateID=$certificateID";
    $result = $conn->query($sql);
    $row=$result->fetch_assoc();
    require("../backend/createcertificate.php");
    $drawName = drawName($row["nameFont"],$row["nameFontSize"],$row["nameTextColor"],$row["alignName"]);
    $drawRegNumber = drawReg($row["regFont"],$row["regFontSize"],$row["regTextColor"],$row["alignReg"]);
    drawOnImage($rows["regNumber"],$rows["studentName"],$row["image"],$row["regXCoordinate"],$row["regYCoordinate"],$row["nameXCoordinate"],$row["nameYCoordinate"],$rows["regNumber"],$drawRegNumber,$drawName,true);
    $image = 'certificates/'.$rows["regNumber"].'.png';
    $conn->close();
}

require("../backend/mailconfig.php");
if(sendcertificate($mail,$mailto,$regID,'certificates/'))
    echo "Success";
else
    echo "Failed";

?>