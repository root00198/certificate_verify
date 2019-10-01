<?php
include 'conn.php';
if(isset($_POST["certificateID"]))
{
    include_once("createcertificate.php");
    include_once("mailconfig.php");

    $certificateid = $_POST["certificateID"];
    $sql = "SELECT * FROM student where certificateID=".$certificateid;
    $studentdata = $conn->query($sql);

    $sql = "SELECT * FROM certificate where certificateID=".$certificateid;
    $certificatedata = $conn->query($sql);
    $row = $certificatedata->fetch_assoc();
    $drawName = drawName($row["nameFont"],$row["nameFontSize"],$row["nameTextColor"],$row["alignName"]);
    $drawRegNumber = drawReg($row["regFont"],$row["regFontSize"],$row["regTextColor"],$row["alignReg"]);

    $v="";
    $cnt = 0;

    while($rows=$studentdata->fetch_assoc())
    {
        drawOnImage($rows["regNumber"],$rows["studentName"],$row["image"],$row["regXCoordinate"],$row["regYCoordinate"],$row["nameXCoordinate"],$row["nameYCoordinate"],$rows["regNumber"],$drawRegNumber,$drawName);
        if(!sendcertificate($mail,$rows["studentEmail"],$rows["regNumber"]))
        {
            $cnt++;
            $v.=$rows["regNumber"]."\n";
        }
    }
    if($cnt==0)
        print("success");
    else
        print("Failed - ".$cnt."\n".$v);
    die();
}

?>


<?php include 'index1.php' ?>

<div class="content-page">
    <div class="content">
        <div class="container-fluid">
                        
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Mail Certificate</h4>
                    </div>
                </div>
            </div>
            <div class="card-box">
                    <div class="form-group">
                        
                            <label>Select Certificate</label>
                            <select class="selectpicker" id="certificateID" name="certificateID">
                                <option selected disabled hidden>Select One</option>     
                                <?php 

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
                            <button class="btn btn-primary waves-effect waves-light mr-1" onclick="callajax()" type="submit" name="submit" value="Submit">
                                Submit
                            </button>
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <!-- <label class="col-sm-2 col-form-label" for="example-textarea">Status</label> -->
                        <div class="col-sm-12">
                            <textarea class="form-control" readonly="" id="status" rows="5">Status</textarea>
                        </div>
                    </div>
                </div>

            


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

function callajax()
{
    var cid = document.getElementById("certificateID").value;
    document.getElementById("overlay").style.display = "block";
    var request = $.ajax({    
            type: "POST",
            url: "mailcertificate.php",
            data: {"certificateID" : cid},
            });
            request.done(function( msg ) {
                document.getElementById("status").value=msg;
                document.getElementById("overlay").style.display = "none";
            });
            request.fail(function(jqXHR, textStatus) {
                document.getElementById("overlay").style.display = "none";
                document.getElementById("status").value="internal server error";
            });
}

</script>


        </div>
    </div>
</div>
<?php $conn->close(); ?>
<?php include 'index2.php' ?>