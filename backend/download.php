<?PHP
include 'conn.php';

$sql="SELECT * FROM student where certificateID=".$_GET["id"];

function cleanData(&$str)
{
  $str = preg_replace("/,/", " ", $str);
  $str = preg_replace("/\r?\n/", "", $str);
  if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
}

// filename for download
$filename = $_GET["name"] . ".csv";


header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Type: application/vnd.ms-excel");

$flag = false;
$result = $conn->query($sql) or die('Query failed!');
while($row=$result->fetch_assoc()) {
  if(!$flag) {
    echo implode(",", array_keys($row)) . "\r\n";
    $flag = true;
  }
  array_walk($row, __NAMESPACE__ . '\cleanData');
  echo implode(",", array_values($row)) . "\r\n";
}
$conn->close();
exit;
?>