<?php
$dsn = "pgsql:"
    . "host=ec2-23-21-161-153.compute-1.amazonaws.com;"
    . "dbname=dfnau2c20ikt1v;"
    . "user=qqldptzbgskfay;"
    . "port=5432;"
    . "sslmode=require;"
    . "password=3aCt96iydyR59_GmRL2ltLaXU3";
$db = new PDO($dsn);

$subjectAndSection=$_POST[subject]." ".$_POST[course];

$sql="INSERT INTO entries (name, class) VALUES ('$_POST[name]','$subjectAndSection')";

// Performs the $sql query on the server to insert the values
$db->query($sql);

header( "Location: https://blooming-reef-3850.herokuapp.com" ) ;
?>