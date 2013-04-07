<?php

//uses the PHP SDK.  Download from https://github.com/facebook/facebook-php-sdk
require 'facebookphp/src/facebook.php';

$facebook = new Facebook(array(
  'appId'  => '358797270908365',
  'secret' => '8b5ad4ac3c4a166d0717c91f85c99cd6',
));

$userId = $facebook->getUser();

$dsn = "pgsql:"
    . "host=ec2-23-21-161-153.compute-1.amazonaws.com;"
    . "dbname=dfnau2c20ikt1v;"
    . "user=qqldptzbgskfay;"
    . "port=5432;"
    . "sslmode=require;"
    . "password=3aCt96iydyR59_GmRL2ltLaXU3";
$db = new PDO($dsn);

?>

<!DOCTYPE html>
<html>
  <head>
    <title>clapp</title>
    <link rel="stylesheet" href="stylesheets/styles.css" type="text/css">
    <link rel="Shortcut Icon" href="images/favicon.ico">
    <link type='text/css' rel='stylesheet' href='https://fonts.googleapis.com/css?family=Lobster'/>
    <link type='text/css' rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'/>

    <script type="text/javascript" src="javascript/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="javascript/script.js"></script>
  </head>
  
  <body>

      <script>

       window.fbAsyncInit = function() {
            FB.init({
              appId      : '358797270908365', // App ID
              channelUrl : '//blooming-reef-3850.herokuapp.com/channel.html', // Channel File
              status     : true, // check login status
              cookie     : true, // enable cookies to allow the server to access the session
              xfbml      : true  // parse XFBML
            });


            FB.Event.subscribe('auth.login', function(response) {
            window.location.reload();
          });

          };

          // Load the SDK Asynchronously
          (function(d, s, id){
             var js, fjs = d.getElementsByTagName(s)[0];
             if (d.getElementById(id)) {return;}
             js = d.createElement(s); js.id = id;
             js.src = "//connect.facebook.net/en_US/all.js";
             fjs.parentNode.insertBefore(js, fjs);
           }(document, 'script', 'facebook-jssdk'));
      </script>
    <div id="top">
    </div>
    <div id="wrapper">
        <div id="header">
            <div id="logo">
                <a href="#home">
                  <div style="display:inline-block; float:left;">
                      <img src="/images/icon.png"/>
                      <h1>cla<span style="color:#333;">pp</span></h1>
                  </div>
                </a>
            </div>
            <div id="nav">
                <a href="#classes">classes</a>
                <a href="#friends">friends</a>
                <a href="#about">about</a>
                <a href="#other">other</a>
            </div>

        </div>
        <div id="main">
            <div id="home_sec" style="display:none;">
                <div class="contentwrapper">
                  <?php if ($userId) { 
                  $userInfo = $facebook->api('/' . $userId);
                  $mySchoolId = $userInfo['education'][count($userInfo['education'])-1]['school']['id'];
                  $schoolInfo = $facebook->api('/' . $mySchoolId);
                  $schoolName= $schoolInfo['name']  ;

                //create the url
                $profile_pic =  "http://graph.facebook.com/".$userId."/picture?height=200&width=200";
                  ?>
                  <div class="titleblock">
                    Hello <span style="font-color:#DFFFA5;"><?= $userInfo['name'] ?></span>, from <?= $schoolName ?>
                    <?echo "<br><br><img class='peeps' src=\"" . $profile_pic . "\"/>"; ?>
                  </div>
                  <div style="text-align:center">
                    <p>
                      Welcome to <span style="font-family:'Lobster'; font-size:18px; font-color:#333;">clapp</span>, the best app to connect with your classmates. To begin, enter your classes on the following page. 
                    </p>
                  </div>
                  <br>
                  <div id="button" style="text-align:center">
                    <a href="#classes">Begin</a>
                  </div>
                        <!-- list of current classes, if any -->
                  <?php } 
                  else { ?>
                    <div id="someelse">
                      <h1>Log in to Facebook to begin:</h1>
                      <fb:login-button scope="friends_education_history,friends_likes" size="xlarge"></fb:login-button>
                    </div>
                  <?php } ?>
                </div>
            </div>
            <div id="classes_sec" style="display:none;">
                <div class="contentwrapper">
                    <div class="titleblock">
                        Classes
                    </div>
                    <div class="column">
                      <h3>Your Classes</h3>

 								<?php
                                	$query = "SELECT class FROM entries WHERE fbid = '$userId' ORDER BY class ASC;";
                                  $number=0;
                                	$result = $db->query($query);
                                	while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                            $number=$number+1;
                                            echo '<div class="remove"><form action="delete.php" method="post">
                                             <input type="hidden" name="fbid" value="';
                                             echo $userId;
                                             echo '">';
                                             echo '<input type="hidden" name="class" value="';
                                             echo $row["class"];
                                             echo'">';
                                             echo '<input type="submit" value="x" style="background:#ff6666;"/></form></div>';
                                             echo "<div  class='sub'><a href='#classes' id='#class".$number."'>".$row["class"] . "</a></div><br><br>";
                                }
                                $result->closeCursor();
                                ?>

                        <form action="insert.php" method="post">
                              <label>Add more classes:</label>
                              <select name="subject">
                                <?php
                                  $query = "SELECT fullname FROM subjects ORDER BY fullname ASC";
                                  $result = $db->query($query);
                                  while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                            echo "<option value=\"" . $row["fullname"] . "\">" . $row["fullname"] . "</option>";
                                }
                                $result->closeCursor();
                                ?>
                              </select>
                              <input id="course" name="course" placeholder=" Course #" style="width:52px;border-radius:3px;margin-left:3px;" required>
                              <input type="submit" value="+" style="background:#DFFFA5;"/>
                              <input type="hidden" name="fbid" value="<?=$userId?>">
                        </form>
                    </div> 
                    <div id="classwrapper">
                    <?php
                                	$query = "SELECT class FROM entries WHERE fbid = '$userId' ORDER BY class ASC;";

                                	$result = $db->query($query);
                                	$number=0;
                                	while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                     //for each class
                                		$number=$number+1;

                     echo '<div id="class';
                     echo $number;
                     echo '" style="display:none">';

                     $className=$row['class'];
                     echo '<h3>';
                     echo $className;
                     echo '</h3><br>';
                       $query2 = "SELECT fbid FROM entries WHERE class = '$className';";
                          $result2 = $db->query($query2);
                          while ($row2 = $result2->fetch(PDO::FETCH_ASSOC)) {
                          //display people in this class           
                      echo '<div class="profile">';
                          $profile_pic =  "http://graph.facebook.com/".$row2['fbid']."/picture";
                             	//echo "<img class='peeps' src=\"" . $profile_pic . "\" />&nbsp&nbsp&nbsp&nbsp";


                    $facebookUrl = "https://graph.facebook.com/".$row2['fbid']; 
					          $str = file_get_contents($facebookUrl); 
          					$result3 = json_decode($str); 
          					//echo $result3->name; 
                          echo "<a href='http://facebook.com/".$row2['fbid']."'><img class='peeps' src=\"".$profile_pic."\"/>&nbsp&nbsp&nbsp&nbsp".$result3->name."</a>";
                     echo "</div>";
                         }
                     echo '</div>';
                                }
                                //closecursor?
                                ?>
                              </div>
                </div>
            </div>
            <div id="friends_sec" style="display:none;">
                <div class="contentwrapper">
                    <div class="titleblock">
                        Your <span>clapp</span> friends
                    </div>
                    <div style="padding-left:120px">
                        	<?php
                        	$fql = "SELECT uid, name FROM user WHERE is_app_user AND uid IN (SELECT uid2 FROM friend WHERE uid1 = me())";
                 
                          $response = $facebook->api(array(
                               'method' => 'fql.query',
                               'query' =>$fql,
                          ));

                              foreach ($response as &$friend) {
                              	$friendId=$friend['uid'];
                              	$friendName=$friend['name'];
                          $profile_pic =  "http://graph.facebook.com/".$friendId."/picture";

                              	echo "<div id='$friendId' class='asdf' >";

                         		   echo "<img class='peeps' src=\"" . $profile_pic . "\" />&nbsp&nbsp&nbsp&nbsp"; 
                            	 echo "</div>";
                               echo '<div id="mouseover'.$friendId.'" style="display:none;position: absolute;z-index:1000;background-color:#DFFFA5;padding:15px;border:2px solid #006633;position: absolute;z-index:1000;">';
                               echo $friendName;
                               echo '<ul>';

                                      
                                  
                                  $query = "SELECT class FROM entries WHERE fbid = '$friendId' ORDER BY class ASC;";
                                  $result10 = $db->query($query);
                                  while ($row = $result10->fetch(PDO::FETCH_ASSOC)) {  
                                             
                                             echo '<li>';
                                             echo $row["class"];
                                             echo '</li>';
                                  }
                                  $result10->closeCursor();
                                  echo '</ul>';
                                  echo '</div>';
                            		}
                              ?>
                      </div>
                </div>
            </div>
            <div id="about_sec" style="display:none;">
                <div class="contentwrapper">
                    <div class="titleblock">
                        About
                    </div>
                    <p> 
                      Clapp is the best way to connect to your classmates. Enter your schedule and find the other members of that class, as well as the classes that your friends are in, and get clapping.
                    </p>
                    <p>
                      This website was made by Alex Pien, Howard Chung, Kevin Jian, and Vincent Wang of DLnk Industries for the HackBlue 2013 hackathon at Duke University.
                    </p>
                </div>
            </div>  
            <div id="other_sec" style="display:none;">
                <div class="contentwrapper">
                    <div class="titleblock">
                        Other
                    </div>

                    <p>
                        Mutual Likes (MuLi): Search for friends with the most common interests.
                    </p>
                      <?php
                                      $fql = "SELECT page_id, name FROM page WHERE page_id IN (SELECT page_id FROM page_fan WHERE uid=me())";
                       
                              $response = $facebook->api(array(
                                'method' => 'fql.query',
                                'query' =>$fql,
                              ));
                                foreach ($response as &$like) {
                                $likeId=$like['page_id'];
                                $likeName=$like['name'];
                              
                            //create the url
                              $profile_pic =  "http://graph.facebook.com/".$likeId."/picture";
                                echo "<p>";
                                //echo the image out
                                echo "<img class='peeps' src=\"" . $profile_pic . "\" />";
                                             echo $likeName;
                                echo "</p>";
                          }
                      ?>
                </div>
            </div>  
        </div>
    </div>
  <div id="footer">
    &copy DLnk Industries 2013
  </div>
</body>
</html>
