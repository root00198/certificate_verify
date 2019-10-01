<?php include 'index1.php'; ?>

<div class="content-page">
    <div class="content">
        <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">Add a Certificate</h4>
                </div>
            </div>
        </div>

            <form method="POST" action="addcertificate.php" enctype="multipart/form-data">
            
            

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <h4 class="header-title">Certificate Settings</h4>
                            <p class="sub-header">Settings For Certificate</p>

                            <div class="form-group">
                                <label>Name of  The Certificate</label>
                                    <input type="text" class="form-control" name="certificateName" id="certificateName" placeholder="Unique Name for the Certificate">
                            </div>

                            <div class="form-group">
                                <label>Certificate</label>
                                    <input type="file" class="form-control" accept=".png,.jpeg,.jpg" id="myimage" onchange="readURL()" name="myimage">
                            </div>
                            <div class="form-group">
                                <label>Name of  The Course</label>
                                    <input type="text" class="form-control" name="coursename" id="coursename" placeholder="Name to be printed in frontend">
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Date of commencement</label>
                                            <input type="text" class="form-control" name="startdate" id="startdate" placeholder="31st July 2019">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Data of completion</label>
                                            <input type="text" class="form-control" name="enddate" id="enddate" placeholder="31st August 219">
                                    </div>
                                </div>
                            <div>

                        </div>
                    </div>
                </div>

                <div class="row">
                
                    <div class="col-lg-6">
                        <div class="card-box">
                            <h4 class="header-title">Name Settings</h4>
                            <p class="sub-header">Settings For Name To Be Printed On The Certificate</p>

                                <div class="form-group">
                                    <label>X Coordinate for the Name</label>
                                    <input type="number" name="nameXCoordinate" placeholder="920" class="form-control" id="nameXCoordinate">
                                </div>
                                <div class="form-group">
                                    <label>Y Coordinate for the Name</label>
                                    <input type="number" name="nameYCoordinate" placeholder="360" class="form-control" id="nameYCoordinate">
                                </div>

                                <div class="form-group">
                                    <label>Name Font</label>
                                        <select class="selectpicker" id="nameFont" name="nameFont">
                                            <?php include 'selectfont.php'; ?>
                                        </select>
                                </div>

                                <div class="form-group">
                                    <label>Name text Color</label>
                                    <input type="color" class="colorpicker-default form-control" value="#000000" id="nameTextColor" name="nameTextColor">
                                    <!-- <input name="Color Picker" type="color"/> -->
                                </div>

                                <div class="form-group">
                                    <label>Name Font Size</label>
                                    <input type="number" name="nameFontSize" placeholder="40" class="form-control" id="nameFontSize">
                                </div>
                                <div class="form-group">
                                    <label>Name Alignment</label>
                                        <select class="selectpicker" id="alignName" name="alignName">
                                            <option value="CENTER">Center</option>
                                            <option value="LEFT">Left</option>
                                            <option value="RIGHT">Right</option>
                                        </select>
                                </div>
                                
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card-box">
                            <h4 class="header-title">Registration Number Settings</h4>
                            <p class="sub-header">Settings For Regitration Number To Be Printed On The Certificate</p>

                                <div class="form-group">
                                    <label>X Coordinate for the Registration Number</label>
                                    <input type="number" name="regXCoordinate" placeholder="1160" class="form-control" id="regXCoordinate">
                                </div>
                                <div class="form-group">
                                    <label>Y Coordinate for the Registration Number</label>
                                    <input type="number" name="regYCoordinate" placeholder="885" class="form-control" id="regYCoordinate">
                                </div>

                                <div class="form-group">
                                    <label>Registration Number Font</label>
                                        <select class="selectpicker" id="regFont" name="regFont">
                                            <?php include 'selectfont.php'; ?>
                                        </select>
                                </div>

                                <div class="form-group">
                                    <label>Registration Number text Color</label>
                                    <input type="color" class="colorpicker-default form-control" value="#000000" id="regTextColor" name="regTextColor">
                                    <!-- <input name="Color Picker" type="color"/> -->
                                </div>

                                <div class="form-group">
                                    <label>Registration Number Font Size</label>
                                    <input type="number" name="regFontSize" placeholder="30" class="form-control" id="regFontSize">
                                </div>
                                <div class="form-group">
                                    <label>Registration Number Alignment</label>
                                        <select class="selectpicker" id="alignReg" name="alignReg">
                                            <option value="CENTER">Center</option>
                                            <option value="LEFT">Left</option>
                                            <option value="RIGHT">Right</option>
                                        </select>
                                </div>
                                
                        </div> <!-- end card-box -->
                    </div>
                </div>

                <!-- Preview Image -->
                <div class="row">
                    <div class="col-12">
                        <div class="card-box">

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Preview Name</label>
                                        <input type="text" placeholder="Naman Aggarwal" class="form-control" id="previewName">
                                    </div>
                                </div>
                                <div class="col-md-4 mt-4 mt-md-0">
                                    <div class="form-group">
                                        <label>Preview Registration Number</label>
                                        <input type="text" placeholder="KST-0001" class="form-control" id="previewReg">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label>Preview</label>
                                    <button type="button" class="btn btn-secondary waves-effect waves-light width-md" onclick="pv();">
                                        Preview
                                    </button>
                                </div>
                            </div>
                        

                            <div class="row" id="previewImage">
                                <div class="card">
                                    <img class="card-img-top img-fluid" id="preview" src="#" alt="Preview Image">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <h4 class="header-title">File Settings</h4>
                            <p class="sub-header">Settings For Student Details - This file should contain 3 columns (1st coloumn should be Registration Number, 2nd column should be Student Name and 3rd column should be the email of the student), Ist row of the csv file will be igonred.</p>

                            <div class="form-group row">
                                <label>Student data</label>
                                    <input type="file" class="form-control" accept=".csv" id="studentdata" name="studentdata">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group text-right mb-0">
                        <button class="btn btn-primary waves-effect waves-light mr-1" type="submit" name="submit" value="Submit">
                            Submit
                        </button>
                        <button type="reset" class="btn btn-light waves-effect width-md">
                            Cancel
                        </button>
                    </div>
                </div>
        
            </form>
<script>

function readURL() {
    var input = document.getElementById("myimage");
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $('#preview').attr('src', e.target.result);
    }
    
    reader.readAsDataURL(input.files[0]);
  }
  setImageVisible("previewImage","true");
}

function setImageVisible(id, visible) {
    var img = document.getElementById(id);
    img.style.display  = (visible ? 'block' : 'none');
}

var img = document.getElementById("previewImage");
img.style.display  = 'none';

</script>

<script>
    function pv()
    {
        if(document.getElementById("myimage").value==""){alert("Please Enter A valid image."); return;}
        if(document.getElementById("regXCoordinate").value==""){alert("Please Enter X coordinates for Registration Number."); return;}
        if(document.getElementById("regYCoordinate").value==""){alert("Please Enter Y coordinates for Registration Number."); return;}
        if(document.getElementById("nameXCoordinate").value==""){alert("Please Enter X coordinates for Name."); return;}
        if(document.getElementById("nameYCoordinate").value==""){alert("Please Enter Y coordinates for Name."); return;}
        if(document.getElementById("nameFontSize").value==""){alert("Please Enter Font size for Name."); return;}
        if(document.getElementById("regFontSize").value==""){alert("Please Enter Font size for Registration Number."); return;}
        if(document.getElementById("previewName").value==""){alert("Please Enter a vaild preview name."); return;}
        if(document.getElementById("previewReg").value==""){alert("Please Enter a valid preview registration number."); return;}


        var formData = new FormData();
        formData.append("myimage", $('#myimage')[0].files[0]);
        formData.append("regXCoordinate",document.getElementById("regXCoordinate").value);
        formData.append("regYCoordinate",document.getElementById("regYCoordinate").value);
        formData.append("nameXCoordinate",document.getElementById("nameXCoordinate").value);
        formData.append("nameYCoordinate",document.getElementById("nameYCoordinate").value);
        formData.append("nameFontSize",document.getElementById("nameFontSize").value);
        formData.append("regFontSize",document.getElementById("regFontSize").value);
        formData.append("nameTextColor",document.getElementById("nameTextColor").value);
        formData.append("regTextColor",document.getElementById("regTextColor").value);
        formData.append("nameFont",document.getElementById("nameFont").value);
        formData.append("regFont",document.getElementById("regFont").value);
        formData.append("alignReg",document.getElementById("alignReg").value);
        formData.append("alignName",document.getElementById("alignName").value);
        formData.append("name",document.getElementById("previewName").value);
        formData.append("registration",document.getElementById("previewReg").value);
        

        document.getElementById("overlay").style.display = "block";
        $.ajax({    
            type: "POST",
            url: "preview.php",
            data: formData,
            enctype: 'multipart/form-data',
            processData: false,
            contentType: false
            }).done(function( msg ) {
                document.getElementById("preview").src=msg;
                document.getElementById("overlay").style.display = "none";
                //alert(msg);
            });
    } 
</script>

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


<?php
if(isset($_POST["submit"]))
{
    //var_dump($_FILES);
    $fileType = pathinfo($_FILES["myimage"]["name"],PATHINFO_EXTENSION);
    $allowTypes = array('jpg','png','jpeg');
    if(in_array($fileType,$allowTypes)==false)
    {
        echo "<script>alert(\"Only Jpg, Png and Jpeg file are accepted\")</script>";
        die();
    }

    $fileType2 = pathinfo($_FILES["studentdata"]["name"],PATHINFO_EXTENSION);
    $allowTypes2 = array("csv");
    if(in_array($fileType2,$allowTypes2)==false)
    {
        echo "<script>alert(\"Only CSV file are accepted\")</script>";
        die();
    }

    include 'conn.php';
    

    $var1="(";
    $var2="(";
        
    foreach($_POST as $i=>$j)
    {   
        if($i=="myimage" || $i=="submit")
            continue;
        $var1 .= $i.',';
        $var2 .= "'".$j."'".','; 
    }
    $var1=rtrim($var1,", ");
    $var2=rtrim($var2,", ");

    $var1 .= ')';
    $var2 .= ')';
    $sql = "INSERT INTO certificate ".$var1." VALUES ".$var2;
    //echo($sql."\n");
    $result = $conn->query($sql);


    $var1="regXCoordinate=\"".$_POST["regXCoordinate"]."\"";

    foreach($_POST as $i=>$j)
    {
        if($i=="certificate" || $i=="regXCoordinate" || $i=="submit")
            continue;
        $var1 .= " && $i=\"$j\"";
    }
    $sql = "SELECT certificateID FROM certificate where $var1";  
    //echo($sql."\n");   
    $result = $conn->query($sql);

    $row=$result->fetch_assoc();

    $certificateid = $row["certificateID"];

    $fileRename = $certificateid;
    $targetDir = "../images/";
    $_FILES["myimage"]["name"] = $fileRename.".".$fileType;
    $fileName = basename($_FILES["myimage"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    move_uploaded_file($_FILES["myimage"]["tmp_name"], $targetFilePath);

    $sql = "UPDATE certificate set image=\"".$_FILES["myimage"]["name"]."\" where certificateID=".$certificateid;
    $result = $conn->query($sql);

    //DONE
    $handle = @fopen($_FILES["studentdata"]["tmp_name"], "r");
    if ($handle) 
    {
        $f=true;
        while (($buffer = fgets($handle, 4096)) !== false) 
        {
            if($f)
            {
                $f=false;
                continue;
            }
            $arr = explode(",",$buffer);
            //var_dump($arr);
            if($arr[0]=="")
                continue;
            $sql = "INSERT INTO student VALUES(\"".$arr[0]."\",\"".$arr[1]."\",\"".$certificateid."\",\"".$arr[2]."\")";
            $result = $conn->query($sql);
            //echo $buffer;
        }
        fclose($handle);
    }
    //CSV File System start

    $conn->close();
    echo('<script>alert("success")</script>');
}
?>


</div> 
    </div> 
</div>

<?php include 'index2.php'; ?>