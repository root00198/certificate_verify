<?php include 'index1.php' ?>

<div class="content-page">
    <div class="content">
        <div class="container-fluid">
                        
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Bulk Download</h4>
                    </div>
                </div>
            </div>

            <form method="post" action="bulkdownload.php">
                <div class="form-group">
                    <label>Select Certificate</label>
                        <select class="selectpicker" id="certificateID" name="certificateID">
                            <option selected disabled hidden>Select One</option>     
                            <?php include 'conn.php';

                                $sql = "SELECT certificateID,certificateName from certificate";
                                $result = $conn->query($sql);

                                while($row=$result->fetch_assoc())
                                {
                                    echo "<option value=\"".$row["certificateID"]."\">".$row["certificateName"]."</option>";
                                }

                            ?>
                        </select>
                </div>
                <div class="row">
                    <div class="form-group text-right mb-0">
                        <button class="btn btn-primary waves-effect waves-light mr-1" onclick="return Overlay()" type="submit" name="submit" value="Submit">
                            Submit
                        </button>
                    </div>
                </div>
            </form>

            


            <style>
#overlay {
  position: fixed;
  display: none;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0,0,0,0.5);
  z-index: 2;
  cursor: pointer;
}

#text{
  position: absolute;
  top: 50%;
  left: 50%;
  font-size: 50px;
  color: white;
  transform: translate(-50%,-50%);
  -ms-transform: translate(-50%,-50%);
}
</style>
<div id="overlay">
  <div id="text">Please Wait!!!</div>
</div>

<script>

function Overlay()
{
    document.getElementById("overlay").style.display = "block";
    return true;
}

</script>


<?php
include_once("createcertificate.php");

function deleteBulk()
{   
    $files = glob('../temp/*');
    foreach($files as $file){
        if(is_file($file)){
            unlink($file);
        }
    }
}

function downloadZip($save)
{
    echo('<br><br>
    <div class="row">
            <div class="form-group text-right mb-0"> Download will be started automatically, If it doesnot, click download
                <a id="downloadme" href="../certificate/'.$save.'.zip" style="" download="certificate.zip">
                <button class="btn btn-primary waves-effect waves-light mr-1" type="submit">
                    
                    Download
                </button>
                </a>
            </div>
        </div>');
//     echo('<script type="text/javascript">
//     $(document).ready(function () {
 
//         $("downloadme").click();
 
//     });
// </script>');
}
if(isset($_POST["submit"]))
{
    include 'conn.php';
    $certificateas = $_POST["certificateID"];

    $sql = "SELECT * FROM certificate where certificateID=\"".$certificateas."\"";
    $result = $conn->query($sql);

    if($result->num_rows==0)
    {
        echo("<script>alert(\"Fatal Error TRY AGAIN\");</script>");
        die();
    }
    $row=$result->fetch_assoc();
    $certificateID = $row["certificateID"];

    $sql = "SELECT * FROM student where certificateID=$certificateID";
    $results = $conn->query($sql,MYSQLI_STORE_RESULT);

    $drawName = drawName($row["nameFont"],$row["nameFontSize"],$row["nameTextColor"],$row["alignName"]);
    $drawRegNumber = drawReg($row["regFont"],$row["regFontSize"],$row["regTextColor"],$row["alignReg"]);

    $i=0;
    $j=0;
    while($rows=$results->fetch_assoc())
    {
        if($i==100)
            break;
        $j+=1;
        if(file_exists("../temp/".$rows["regNumber"].".png"))
            continue;
        $i+=1;
        drawOnImage($rows["regNumber"],$rows["studentName"],$row["image"],$row["regXCoordinate"],$row["regYCoordinate"],$row["nameXCoordinate"],$row["nameYCoordinate"],$rows["regNumber"],$drawRegNumber,$drawName);
    }

    if($i==100)
        echo '<script>alert("'.$j.'/'.$results->num_rows.' completed");</script>';
    else
    {
        // date_default_timezone_set("Asia/Kolkata");$date = date('Y-m-d')."-".date("H:i:s");
        // $zip = new ZipArchive();
        // $zip->open('../temp/'.md5($date).'.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);
        // $results->data_seek(0);
        // while($rows=$results->fetch_assoc())
        // {
        //     $zip->addFile('../temp/'.$rows["regNumber"].".png");
        // }
        // $zip->close();
        // downloadZip(md5($date).".zip");
        // deleteBulk();
    }
    $conn->close();
}

?>








        </div>
    </div>
</div>


<?php include 'index2.php' ?>