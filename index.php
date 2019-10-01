<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Verify Certification - Theme developed by Icealle Tech</title>
    <link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
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

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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



<div class="container v-align">
    <div class="wrapper">
        <h5>Certificate Verification</h5>
        <div>
                <div class="form-group text-group">
                    <label for="certificate-number">Certificate Number</label>
                    <input type="text" id="certificate-number" placeholder="Enter Certificate Number" name="cert-no" class="form-control" autofocus>
                    <p class="small">This field is required</p>
                </div>

                <div class="form-group text-right">
                    <button type="submit" class="btn btn-block btn-primary" onclick="validate()" name="cert-no-sub">VERIFY</button>
                </div>
        </div>

        <div class="small text-secondary">
            <p>
            Enter your registration number and click on verify now to obtain the digital copy of your course completion certificate with What After College. 
            Make sure the information entered is by you is correct.
            Contact “our support platform” if you face any issues.
            </p>
        </div>

    </div>
</div>

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

<script>
    function validate()
    {
        var regID = document.getElementById("certificate-number").value;
        $.ajax({    
            type: "POST",
            url: "validate.php",
            data: {regID : regID,},
            }).done(function( msg ) {
                if(msg=="success")
                {
                    window.location = "https://whataftercollege.com/certificate_verify/certificate/".concat(regID);
                }
                else
                {
                    alert("falied!");
                }
            });
    }
</script>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>


</body>
</html>