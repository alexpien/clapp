<?php

$dsn = "pgsql:"
    . "host=ec2-23-21-161-153.compute-1.amazonaws.com;"
    . "dbname=dfnau2c20ikt1v;"
    . "user=qqldptzbgskfay;"
    . "port=5432;"
    . "sslmode=require;"
    . "password=3aCt96iydyR59_GmRL2ltLaXU3";
$db = new PDO($dsn);
                                  
                                  $query = "SELECT class FROM entries WHERE fbid = '$_POSTfbid' ORDER BY class ASC;";
                                  $result = $db->query($query);
                                  while ($row = $result->fetch(PDO::FETCH_ASSOC)) {                  
                                             echo $row["class"];

                                }
                                $result->closeCursor();
                                ?>