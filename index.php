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
    <link type="text/css" href="inputstyle.css" rel="stylesheet"/>

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
                        $profile_pic =  "http://graph.facebook.com/".$userId."/picture";
                              ?>
                              <div class="titleblock">
                              Welcome,<br>
                              <?= $userInfo['name'] ?> - <?= $schoolName ?>
                              <?echo "<br><br><img src=\"" . $profile_pic . "\" height=72/>"; ?>

            
                    </div>
                    <div style="text-align:center">
                      <p>
                        Welcome to <span style="font-family:'Lobster';">clapp</span>, the best app to connect with your classmates. To begin, enter your classes below. 
                      </p>
                    </div>
                      <div style="text-align:center">
                      <form action="insert.php" method="post">
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
                            
                              <input id="section" name="course" placeholder=" Course #" required>

                              <input type="submit" value="+"/>
                              <input type="hidden" name="name" value=<?=$userInfo['name']?>>
                      </form>
                    </div>
                          <!-- list of current classes, if any -->
                    <?php } 
                    else { ?>

                    <h1>Log in to Facebook to begin:</h1>
                    <fb:login-button scope="friends_education_history,friends_likes" size="xlarge"></fb:login-button>

                    <?php } ?>
               </div>
            </div>
            <div id="classes_sec" style="display:none;">
                <div class="contentwrapper">
                    <div class="titleblock">
                        Classes
                    </div>
                    <div class="column">
                      c1 your classes
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
                          <input id="section" name="course" placeholder=" Course #" style="width:50px;" required>
                          <input type="submit" value="+"/>
                      </form>
                    </div>                        
                
                    <div class="column">
                        c2 your friends
                    </div>
                    <div class="column">
                        c3 others in class
                    </div>
                </div>
            </div>
            <div id="friends_sec" style="display:none;">
                <div class="contentwrapper">
                    <div class="titleblock">
                        Your <span>clapp</span> Friends
                    </div>
                    <div style="padding-left:100px">
          	        

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
                              	echo "<div class='profile'>";
                              //echo the image out
                         	echo "<img src=\"" . $profile_pic . "\" />&nbsp&nbsp&nbsp&nbsp"; 
                        	    echo $friendName."<br>";
                            	echo "</div>";
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
                      Clapp is the best way to connect to your classmates. Enter your schedule and find the other members of that class, as well as the classes that your friends are in.
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
                        Likes:
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
                            echo "<img src=\"" . $profile_pic . "\" />";
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
