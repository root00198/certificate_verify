<?php

require('backend/conn.php');
$sql = 'SELECT * from student where regNumber="'.$_POST["regID"].'"';
$result = $conn->query($sql);
if($result->num_rows==0)
    echo("failed");
else
    echo("success");
die();
?>