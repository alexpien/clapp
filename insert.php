<?php
$dsn = "pgsql:"
    . "host=ec2-23-21-161-153.compute-1.amazonaws.com;"
    . "dbname=dfnau2c20ikt1v;"
    . "user=qqldptzbgskfay;"
    . "port=5432;"
    . "sslmode=require;"
    . "password=3aCt96iydyR59_GmRL2ltLaXU3";
$db = new PDO($dsn);

//concatenate subject and course
$subjectAndSection=$_POST[subject]." ".$_POST[course];

if ($_POST[fbid]!='0'){}
$sql="INSERT INTO entries (fbid, class) VALUES ('$_POST[fbid]','$subjectAndSection')";

// Performs the $sql query on the server to insert the values
$db->query($sql);
}

header( "Location: https://blooming-reef-3850.herokuapp.com/#classes" ) ;
?>