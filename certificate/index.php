<?php
require("../backend/conn.php");
$regID = explode('/',$_GET["regID"]);
$regID = end($regID);
if($regID=="")
{
    header("location: /certificate_verify/");
    die();
}
if(file_exists('certificates/'.$regID.'.png'))
{
    $sql = "SELECT * from student where regNumber=\"".$regID."\"";
    $result = $conn->query($sql);
    $rows = $result->fetch_assoc();
    $sql = "SELECT * from certificate where certificateID=".$rows["certificateID"];
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $image = 'certificates/'.$regID.'.png';
}
else
{
    $sql = "SELECT * from student where regNumber=\"$regID\"";
    $result = $conn->query($sql);
    if($result->num_rows==0)
    {
        header("location: /certificate_verify/");
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
$name = $rows["studentName"];
$coursename = $row["coursename"];
$startdate = $row["startdate"];
$enddate = $row["enddate"];

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Certificate</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
          integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header class="header_area">
    <div class="main_menu">
        <nav class="navbar navbar-expand-md navbar-light">
            <div class="container">
                <a class="navbar-brand" href="index.html">
                    <img src="img/logo.png">
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                    <ul class="nav navbar-nav menu_nav ml-auto">
                        <li class="nav-item">
                            <a class="btn nav-btn" href="index.html">Dashboard</a>
                            <a class="btn nav-btn" href="index.html">About</a>
                            <a class="btn nav-btn" href="index.html">Features</a>
                            <a class="btn nav-btn-profile" href="index.html">P</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>

<section class="p-2 p-md-5">
    <div class="container certi-content">
        <div class="row">
            <div class="col-md-4 position-relative order-last order-md-first">
                <div class="left-card">
                    <h3><?php echo $name; ?></h3>
                    <p>
                        Course : <?php echo $coursename; ?><br>
                        Date of commencement : <?php echo $startdate; ?><br>
                        Date of completion : <?php echo $enddate; ?><br>
                        Registration Number : <?php echo $regID; ?><br>
                    </p>
                </div>
                <div class="download-btn">
                    <a href="<?php echo $image; ?>" class="btn btn-block" download><i class="fas fa-download"></i> Download</a>
                </div>
            </div>
            <div class="col-md-8 p-md-1 p-3 text-center order-first order-md-last">
                <div class="position-relative certi-image">
                    <img src="<?php echo $image; ?>">
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo "https://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}"; ?>" class="action-btn left-first facebook-btn"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo "https://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}"; ?>&title=&summary=&source=" class="action-btn left-second linkedin-btn"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#" class="action-btn left-third gmail-btn"><i class="fas fa-envelope"></i></a>
                    <a href="<?php echo $image; ?>" class="action-btn right-first" download><i class="fas fa-download"></i></a>
                    <a href="#" class="action-btn right-second"><i class="fas fa-link"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="footer">
    <div class="row footer-content">
        <div class="order-last col-sm-6 order-sm-first">
            <p>©2019 All Rights Reserved.</p>
        </div>
        <div class="col-sm-6 order-sm-last order-first text-md-right text-sm-center">
            <a href="#">
                <i class="fab fa-youtube"></i>
            </a>
            <a href="#">
                <i class="fab fa-linkedin-in"></i>
            </a>
            <a href="#">
                <i class="fab fa-twitter"></i>
            </a>
            <a href="#">
                <i class="fab fa-instagram"></i>
            </a>
        </div>
    </div>
</footer>
<!-- Footer -->


</body>
</html>