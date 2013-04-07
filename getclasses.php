<?php
                                  
                                  $query = "SELECT class FROM entries WHERE fbid = '$POST_fbid' ORDER BY class ASC;";
                                  $result = $db->query($query);
                                  while ($row = $result->fetch(PDO::FETCH_ASSOC)) {                  
                                             echo $row["class"];

                                }
                                $result->closeCursor();
                                ?>