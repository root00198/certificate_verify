<?php

$id = $_POST["email"];
$pass = $_POST["password"];

if($id=="admin" && $pass=="admin")
{
    print("success");
    session_start();
    $_SESSION["access"] = true;
}
else    
    print("error");
?>