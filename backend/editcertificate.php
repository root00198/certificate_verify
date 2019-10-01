<?php   
    include 'conn.php';

    if(isset($_GET["id"]))
        $sql = "SELECT * FROM certificate where certificateID=".$_GET["id"];
    else
        $sql = "SELECT * from certificate";

    $result = $conn->query($sql);
    $row = $result->fetch_assoc();



    if(isset($_POST["submit"]))
    {
        $certificateid = $row["certificateID"];
        $sql = "SELECT * FROM student where certificateID=$certificateid";
        $rppo = $conn->query($sql);
        while($rp = $rppo->fetch_assoc())
        {
            $target = "../certificate/certificates/";
            if(file_exists($target.$rp["regNumber"].".png"))
                unlink($target.$rp["regNumber"].".png");
        }
        if(isset($_FILES["myimage"]) && $_FILES["myimage"]["name"]!="")
        {
            unlink("../images/".$row["image"]);
            unlink("../temp/".$row["image"]);
            $fileRename = $certificateid;
            $targetDir = "../images/";
            $fileType = pathinfo($_FILES["myimage"]["name"],PATHINFO_EXTENSION);
            $_FILES["myimage"]["name"] = $fileRename.".".$fileType;
            $fileName = basename($_FILES["myimage"]["name"]);
            $targetFilePath = $targetDir . $fileName;
            move_uploaded_file($_FILES["myimage"]["tmp_name"], $targetFilePath);
            
            $sql = "UPDATE certificate SET image = \"".$_FILES["myimage"]["name"]."\" where certificateID=".$row["certificateID"];
            $result = $conn->query($sql);
            
        }

        $var1 = "";
        foreach($_POST as $i=>$j)
        {   
            if($i=="submit")
                continue;
            $var1 .= $i."=\"".$j."\",";
        }
        $var1=rtrim($var1,", ");

        $sql = "UPDATE certificate set $var1 where certificateID=$certificateid";
        $result=$conn->query($sql);
        

        if(isset($_FILES["studentdata"]) && $_FILES["studentdata"]["name"]!="")
        {
            $sql = "DELETE FROM student where certificateID=$certificateid";
            $result = $conn->query($sql);
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
        }

        
    
    }
    if(isset($_POST["delete"]))
    {
        $certificateid = $row["certificateID"];
        $sql = "SELECT * FROM student where certificateID=$certificateid";
        $rppo = $conn->query($sql);
        while($rp = $rppo->fetch_assoc())
        {
            $target = "../certificate/certificates/";
            if(file_exists($target.$rp["regNumber"].".png"))
                unlink($target.$rp["regNumber"].".png");
        }
        $sql = "DELETE from certificate where certificateID=".$row["certificateID"];
        $result = $conn->query($sql);

        $sql = "DELETE from student where certificateID=".$row["certificateID"];
        $result = $conn->query($sql);

        unlink("../images/".$row["image"]);
        unset($_GET);
        unset($row);
    }

    if(isset($_GET["id"]))
        $sql = "SELECT * FROM certificate where certificateID=".$_GET["id"];
    else
        $sql = "SELECT * from certificate";


    $result = $conn->query($sql);
    if($result->num_rows==0)
    {
        header("Location: addcertificate.php");
        die();
    }
    $row = $result->fetch_assoc();

    
?>


<?php 
include 'index1.php'; ?>


<div class="content-page">
    <div class="content">
        <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">Edit a Certificate</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card-box">
                    <div class="form-group">
                        <label>Select Certificate</label>
                        <select class="selectpicker" id="certificateID" onchange="javascript:location.href = this.value;" name="certificateID">
                            <option selected disabled hidden>Select One</option>              
                            <?php include 'conn.php';

                                $sql = "SELECT certificateID,certificateName from certificate";
                                $result = $conn->query($sql);

                                while($rowss=$result->fetch_assoc())
                                {
                                    echo "<option value=\"editcertificate.php?id=".$rowss["certificateID"]."\">".$rowss["certificateName"]."</option>";
                                }

                            ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>


        <form method="POST" action="editcertificate.php?id=<?php echo $row["certificateID"]; ?>"  enctype="multipart/form-data">
        
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <h4 class="header-title">Certificate Settings</h4>
                            <p class="sub-header">Settings For Certificate</p>

                            <div class="form-group row">
                                <label>Name of  The Certificate</label>
                                    <input type="text" class="form-control" name="certificateName" id="certificateName" value="<?php echo $row["certificateName"]; ?>">
                            </div>
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="form-group row">
                                        <label>Certificate</label>
                                            <input type="file" class="form-control" accept=".png,.jpeg,.jpg" id="myimage" onchange="readURL()" name="myimage">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label>Download Image</label>
                                    <a href="../images/<?php echo $row["image"]; ?>" download="<?php $arr = explode(".",$row["image"]); echo $row["certificateName"].".".$arr[1]; ?>">
                                        <button type="button" class="btn btn-success waves-effect waves-light width-md">
                                            Download
                                        </button>
                                    </a>
                                </div> 
                            </div>
                            <div class="form-group">
                                <label>Name of  The Course</label>
                                    <input type="text" class="form-control" name="coursename" id="coursename" value="<?php echo $row["coursename"]; ?>">
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Date of commencement</label>
                                            <input type="text" class="form-control" name="startdate" id="startdate" value="<?php echo $row["startdate"]; ?>">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Date of completion</label>
                                            <input type="text" class="form-control" name="enddate" id="enddate" value="<?php echo $row["enddate"]; ?>">
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
                                    <input type="number" name="nameXCoordinate" value="<?php echo $row["nameXCoordinate"]; ?>" class="form-control" id="nameXCoordinate">
                                </div>
                                <div class="form-group">
                                    <label>Y Coordinate for the Name</label>
                                    <input type="number" name="nameYCoordinate" value="<?php echo $row["nameYCoordinate"]; ?>" class="form-control" id="nameYCoordinate">
                                </div>

                                <div class="form-group">
                                    <label>Name Font</label>
                                        <select class="selectpicker" id="nameFont" name="nameFont">
                                            <option value="<?php echo $row["nameFont"]; ?>" selected disabled hidden><?php echo $row["nameFont"]; ?></option>
                                            <?php include 'selectfont.php'; ?>
                                        </select>
                                </div>

                                <div class="form-group">
                                    <label>Name text Color</label>
                                    <input type="color" class="colorpicker-default form-control" value="<?php echo $row["nameTextColor"]; ?>" id="nameTextColor" name="nameTextColor">
                                    <!-- <input name="Color Picker" type="color"/> -->
                                </div>

                                <div class="form-group">
                                    <label>Name Font Size</label>
                                    <input type="number" name="nameFontSize" value="<?php echo $row["nameFontSize"]; ?>" class="form-control" id="nameFontSize">
                                </div>
                                <div class="form-group">
                                    <label>Name Alignment</label>
                                        <select class="selectpicker" id="alignName" name="alignName">
                                            <option value="<?php echo $row["alignName"]; ?>" selected disabled hidden><?php echo $row["alignName"]; ?></option>
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
                                    <input type="number" name="regXCoordinate" value="<?php echo $row["regXCoordinate"]; ?>" class="form-control" id="regXCoordinate">
                                </div>
                                <div class="form-group">
                                    <label>Y Coordinate for the Registration Number</label>
                                    <input type="number" name="regYCoordinate" value="<?php echo $row["regYCoordinate"]; ?>" class="form-control" id="regYCoordinate">
                                </div>

                                <div class="form-group">
                                    <label>Registration Number Font</label>
                                        <select class="selectpicker" id="regFont" name="regFont">
                                            <option value="<?php echo $row["regFont"]; ?>" selected disabled hidden><?php echo $row["regFont"]; ?></option>
                                            <?php include 'selectfont.php'; ?>
                                        </select>
                                </div>

                                <div class="form-group">
                                    <label>Registration Number text Color</label>
                                    <input type="color" class="colorpicker-default form-control" value="<?php echo $row["regTextColor"]; ?>" id="regTextColor" name="regTextColor">
                                    <!-- <input name="Color Picker" type="color"/> -->
                                </div>

                                <div class="form-group">
                                    <label>Registration Number Font Size</label>
                                    <input type="number" name="regFontSize" value="<?php echo $row["regFontSize"]; ?>" class="form-control" id="regFontSize">
                                </div>
                                <div class="form-group">
                                    <label>Registration Number Alignment</label>
                                        <select class="selectpicker" id="alignReg" name="alignReg">
                                            <option value="<?php echo $row["alignReg"]; ?>" selected disabled hidden><?php echo $row["alignReg"]; ?></option>
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
                                    <img class="card-img-top img-fluid" id="preview" src="../images/<?php date_default_timezone_set("Asia/Kolkata");$date = date('Y-m-d')."-".date("H:i:s"); echo($row["image"]."?".$date); ?>" alt="Preview Image">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">

                            <div class="row">
                                <h4 class="header-title">File Settings</h4>
                                <p class="sub-header">Settings For Student Details - This file should contain 3 columns (1st coloumn should be Registration Number, 2nd column should be Student Name and 3rd column should be the email of the student), Ist row of the csv file will be igonred.</p>
                            </div>
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="form-group row">
                                        <label>Student data</label>
                                            <input type="file" class="form-control" accept=".csv" id="studentdata" name="studentdata">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label>Download Student Data</label>
                                    <a href="<?php echo("download.php/?id=".$row["certificateID"]."&name=".$row["certificateName"]); ?>" target="_blank">
                                        <button type="button" class="btn btn-success waves-effect waves-light width-md">
                                            Download
                                        </button>
                                    </a>
                                </div>
                            </div>
            
                        </div>  
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg=12">
                        <div class="form-group text-right mb-0">
                            <button class="btn btn-primary waves-effect waves-light mr-1" type="submit" name="submit" value="Submit">
                                Submit
                            </button>

                            <button  class="btn btn-danger waves-effect waves-light width-md" type="button" onclick="deleteData()">
                                Delete
                            </button>
            
                        </div>  
                    </div>
                </div>

            </form>
<script>

function post(path, params, method='post') {

// The rest of this code assumes you are not using a library.
// It can be made less wordy if you use one.
const form = document.createElement('form');
form.method = method;
form.action = path;

for (const key in params) {
  if (params.hasOwnProperty(key)) {
    const hiddenField = document.createElement('input');
    hiddenField.type = 'hidden';
    hiddenField.name = key;
    hiddenField.value = params[key];

    form.appendChild(hiddenField);
  }
}

document.body.appendChild(form);
form.submit();
}

function deleteData()
{
    var result = confirm("Want to delete?");
    if(result)
    {
        post("editcertificate.php?id=<?php echo $row["certificateID"]; ?>",{"delete" : "true"});
    }
}

function readURL() {
    var input = document.getElementById("myimage");
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $('#preview').attr('src', e.target.result);
    }
    
    reader.readAsDataURL(input.files[0]);
  }
}

</script>

<script>
    function pv()
    {
        if(document.getElementById("myimage").value=="")
        {
            if(document.getElementById("regXCoordinate").value==""){alert("Please Enter X coordinates for Registration Number."); return;}
            if(document.getElementById("regYCoordinate").value==""){alert("Please Enter Y coordinates for Registration Number."); return;}
            if(document.getElementById("nameXCoordinate").value==""){alert("Please Enter X coordinates for Name."); return;}
            if(document.getElementById("nameYCoordinate").value==""){alert("Please Enter Y coordinates for Name."); return;}
            if(document.getElementById("nameFontSize").value==""){alert("Please Enter Font size for Name."); return;}
            if(document.getElementById("regFontSize").value==""){alert("Please Enter Font size for Registration Number."); return;}
            if(document.getElementById("previewName").value==""){alert("Please Enter a vaild preview name."); return;}
            if(document.getElementById("previewReg").value==""){alert("Please Enter a valid preview registration number."); return;}


            var formData = new FormData();
            formData.append("myimage",<?php echo("\"".$row["image"]."\""); ?>);
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
                url: "previewedit.php",
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
        else
        {
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

        </div>
    </div>
</div>
<?php $conn->close(); ?>
<?php include 'index2.php' ?>