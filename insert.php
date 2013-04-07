<?php
$dsn = "pgsql:"
    . "host=ec2-23-21-161-153.compute-1.amazonaws.com;"
    . "dbname=dfnau2c20ikt1v;"
    . "user=qqldptzbgskfay;"
    . "port=5432;"
    . "sslmode=require;"
    . "password=3aCt96iydyR59_GmRL2ltLaXU3";
$db = new PDO($dsn);

$subjectAndSection=$_POST[subject]." ".$_POST[section];
echo $subjectAndSection;

$sql="INSERT INTO entries (name, class) VALUES ('$_POST[name]','$subjectAndSection')";

if (!mysqli_query($db,$sql))
  {
  die('Error: ' . mysqli_error());
  }
echo "1 record added";

?>