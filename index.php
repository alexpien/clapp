<?php

//uses the PHP SDK.  Download from https://github.com/facebook/facebook-php-sdk
require 'facebookphp/src/facebook.php';

$facebook = new Facebook(array(
  'appId'  => '358797270908365',
  'secret' => '8b5ad4ac3c4a166d0717c91f85c99cd6',
));

$userId = $facebook->getUser();

?>

<!DOCTYPE html>
<html>
  <head>
    <title>clapp</title>
    <link rel="stylesheet" href="stylesheets/styles.css" type="text/css">
    <link rel="Shortcut Icon" href="images/favicon.ico">
    <link type='text/css' rel='stylesheet' href='https://fonts.googleapis.com/css?family=Lobster'/>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>

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
        <div class="titleblock">
          
           <?php if ($userId) { 

      $userInfo = $facebook->api('/' . $userId);
      $mySchoolId = $userInfo['education'][count($userInfo['education'])-1]['school']['id'];
      $schoolInfo = $facebook->api('/' . $mySchoolId);
      $schoolName= $schoolInfo['name']  ;

        //create the url
  $profile_pic =  "http://graph.facebook.com/".$userId."/picture";

 //echo the image out
 echo "<img src=\"" . $profile_pic . "\" height=48/>"; 

      ?>

      <?= $userInfo['name'] ?> - <?= $schoolName ?>
      
      
    </div>
      <p>
        You're now on clapp, the best app to connect with your classmates. To begin, enter your classes below:
      </p>
      <p>
        DROPDOWN
      </p>
      <p>
        CLASS NUMBER BOX
      </p>
      <p>
        SUBMIT BUTTON
      </p>

    <?php } 
    else { ?>

    <h1>Log in to Facebook to begin:</h1>
    <fb:login-button scope="friends_education_history,friends_likes"></fb:login-button>

    <?php } ?>
      </div>
      <div id="classes_sec" style="display:none;">
        <div class="titleblock">
          Classes
        </div>
        <div>
          c1 your classes
        </div>
        <div>
          c2 your friends
        </div>
        <div>
          c3 others in class
        </div>
      </div>
      <div id="friends_sec" style="display:none;">
         <div class="titleblock">
          Friends
        </div>
        	<p>
        		At  <?= $schoolName ?>
        	</p>

        	<?php
        	/*
        	$fql = "SELECT page_id, name from page where name='Coke'";
 
$response = $facebook->api(array(
     'method' => 'fql.query',
     'query' =>$fql,
));
*/
      $friendData= $facebook->api('/' . $userId. '?fields=friends.limit(20).fields(education)');
      $friendData=$friendData['friends']['data'];

      foreach ($friendData as &$friend) {
      	$friendId=$friend['id'];
      	$friendInfo= $facebook->api('/' . $friendId);
      	$friendName=$friendInfo['name'];
      	$friendSchoolId=$friend['education'][count($friend['education'])-1]['school']['id'];

	
	if ($mySchoolId==$friendSchoolId){
//create the url
  $profile_pic =  "http://graph.facebook.com/".$friendId."/picture";
	
		$schoolInfo = $facebook->api('/' . $friendSchoolId);
      	$friendSchoolName= $schoolInfo['name'];
      	echo "<p>";
      //echo the image out
 	echo "<img src=\"" . $profile_pic . "\" />"; 
	    echo $friendName."<br>";
    	echo "</p>";
      ?><!-- Facebook Badge START --><a href="https://www.facebook.com/kevin.jian.39" target="_TOP" style="font-family: &quot;lucida grande&quot;,tahoma,verdana,arial,sans-serif; font-size: 11px; font-variant: normal; font-style: normal; font-weight: normal; color: #3B5998; text-decoration: none;" title="Kevin Jian">Kevin Jian</a><span style="font-family: &quot;lucida grande&quot;,tahoma,verdana,arial,sans-serif; font-size: 11px; line-height: 16px; font-variant: normal; font-style: normal; font-weight: normal; color: #555555; text-decoration: none;">&nbsp;|&nbsp;</span><a href="https://www.facebook.com/badges/" target="_TOP" style="font-family: &quot;lucida grande&quot;,tahoma,verdana,arial,sans-serif; font-size: 11px; font-variant: normal; font-style: normal; font-weight: normal; color: #3B5998; text-decoration: none;" title="Make your own badge!">Create Your Badge</a><br/><a href="https://www.facebook.com/kevin.jian.39" target="_TOP" title="Kevin Jian"><img src="https://badge.facebook.com/badge/658008653.2074.1347434826.png" style="border: 0px;" /></a><!-- Facebook Badge END -->
<?}


	}
      ?>
          
        </h1>
      </div>
      <div id="about_sec" style="display:none;">
         <div class="titleblock">
          About
        </div>
        <p> 
          Clapp is the best way to connect to your classmates. Enter your schedule and find the other members of that class, as well as the classes that your friends are in.
        </p>
        <p>
          This website was made by Alex Pien, Howard Chung, Kevin Jian, and Vincent Wang for the HackBlue 2013 hackathon at Duke University.
        </p>
      </div>  
      <div id="other_sec" style="display:none;">
         <div class="titleblock">
          Other
        </div>

          <p>
        Mutual Likes:
    </p>

       <?php
      $myLikes= $facebook->api('/' . $userId. '?fields=likes');
      $myLikesData=$myLikes['likes']['data'];

      foreach ($myLikesData as &$like) {
      	$likeId=$like['id'];
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
  <div style="text-align:center;background-color:#DFFFA5; height:20px">
    us llol
  </div>
</body>
</html>
