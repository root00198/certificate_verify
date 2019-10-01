<?php include 'index1.php'; ?>

<?php
include 'conn.php';
// Main Script

if(isset($_POST["submit"]))
{
    unlink("../certificate/certificates/".$_POST["regNumber"].".png");
    $sql = 'UPDATE student set studentName="'.$_POST["name"].'", studentEmail="'.$_POST["email"].'" where regNumber="'.$_POST["regNumber"].'"';
    //echo $sql;
    $result = $conn->query($sql);
    //$_GET["id"] = $_POST["regNumber"];
    if($result)
        echo '<script>alert("success");</script>';
    else
        echo '<script>alert("failed!!");</script>';
}
if(isset($_POST["certificate"])){
    // unlink("../certificate/certificates/".$_POST["regNumber"].".png");
    //send Certificate Through Email

    include_once('mailconfig.php');
    include_once("createcertificate.php");

    $sql = "SELECT * FROM student where regNumber=\"".$_POST["regNumber"]."\"";
    $result = $conn->query($sql);
    $rows = $result->fetch_assoc();

    $sql = 'SELECT * FROM certificate where certificateID="'.$rows["certificateID"].'"';
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $drawName = drawName($row["nameFont"],$row["nameFontSize"],$row["nameTextColor"],$row["alignName"]);
    $drawRegNumber = drawReg($row["regFont"],$row["regFontSize"],$row["regTextColor"],$row["alignReg"]);

    drawOnImage($rows["regNumber"],$rows["studentName"],$row["image"],$row["regXCoordinate"],$row["regYCoordinate"],$row["nameXCoordinate"],$row["nameYCoordinate"],$rows["regNumber"],$drawRegNumber,$drawName);
    if(!sendcertificate($mail,$rows["studentEmail"],$rows["regNumber"]))
        echo ('<script>alert("Failed");</script>');
    else
        echo ('<script>alert("Success");</script>');
}
if(isset($_POST["delete"]))
{
    unlink("../certificate/certificates/".$_POST["regNumber"].".png");
    $sql = "DELETE FROM student where regNumber=\"".$_POST["regNumber"]."\"";
    //echo $sql;
    $result = $conn->query($sql);
    //echo $result;
    if($result==1)
        echo '<script>alert("Success");</script>';
    else    
        echo '<script>alert("Failed");</script>';
}

?>


<div class="content-page">
    <div class="content">
        <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">Student</h4>
                </div>
            </div>
        </div>

        <form method="GET" action="student.php">

        <div class="row">
            <div class="col-lg-12">
                <div class="card-box">

                    <div class="row">
                        <h4 class="header-title">Enter Student Registration Number</h4>
                    </div>
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="form-group row">
                                    <input type="text" class="form-control" placeholder="<?php if(isset($_GET["id"])){echo $_GET["id"];}else{echo "KST-0001";} ?>" id="id" name="id">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <button type="submit" class="btn btn-success waves-effect waves-light width-md">
                                Submit
                            </button>
                        </div>
                    </div>
    
                </div>  
            </div>
        </div>
        </form>



<?php 
if(isset($_GET["id"]))
{
    $stid = $_GET["id"];
    $sql = "SELECT * from student where regNumber=\"$stid\"";

    $result = $conn->query($sql);
    if($result->num_rows>0){
        $row = $result->fetch_assoc();

?>

<form method="POST" action="student.php">
    <div class="card-box">
       
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="simpleinput">Registration Number</label>
            <div class="col-sm-10">
                <input type="text" readonly="" class="form-control" value="<?php echo $row["regNumber"]; ?>" name="regNumber">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="simpleinput">Student Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" value="<?php echo $row["studentName"]; ?>" name="name">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="simpleinput">Student Email</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" value="<?php echo $row["studentEmail"]; ?>" name="email">
            </div>
        </div>

        <!-- <div class="row"> -->
            <div class="col-12">
                
                <div class="col-md-4">
                    <div class="text-left">
                        <button class="btn btn-primary waves-effect waves-light" type="submit" name="submit" value="Submit">
                            Submit
                        </button>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-left">
                        <button class="btn btn-primary waves-effect waves-light" type="submit" name="certificate" value="certificate">
                            Mail Certificate
                        </button>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-left">
                        <button class="btn btn-danger waves-effect waves-light" type="submit" onclick="return del();" name="delete" value="delete">
                            Delete
                        </button>
                    </div>
                </div>

            </div>
        <!-- </div> -->

    </div>

</form>
<?php
}
else
    echo '<script>alert("Given Registration Number Not Found");</script>';
}
?>

        </div>
    </div>
</div>

<script>
function del()
{
    var result = confirm("Want to delete?");
    return result;
}
</script>

<?php $conn->close(); ?>
<?php include 'index2.php'; ?>