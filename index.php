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
    <title>Clapp</title>
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
        <h1> 
         <?php if ($userId) { 
      $userInfo = $facebook->api('/' . $userId);
      $schoolId = $userInfo['education'][count($userInfo['education'])-1]['school']['id'];
      $schoolInfo = $facebook->api('/' . $schoolId);
      $schoolName= $schoolInfo['name'];
      ?>
      Welcome, <?= $userInfo['name'] ?> from <?= $schoolName ?>!

      <p>
      You're now on clapp, the best app to connect to your classmates.  To begin, enter your classes below:
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
    <?php } else { ?>
    <h1>Log in to Facebook to begin:</h1>
    <fb:login-button></fb:login-button>
    <?php } ?>
      </div>
      <div id="classes_sec" style="display:none;">
        <h1>
Classes
        </h1>
      </div>
      <div id="friends_sec" style="display:none;">
        <h1>
        	<?php
      $friendData= $facebook->api('/' . $userId. '?fields=friends.limit(10).fields(education)');
      $friendData=$friendData['friends']['data'];
      foreach ($friendData as &$friend) {

      	$friendInfo= $facebook->api('/' . $friend['id']);
		$friendName=$friendInfo['name'];

		$friendSchoolId=$friend['education'][count($friend['education'])-1]['school']['id'];
		$schoolInfo = $facebook->api('/' . $friendSchoolId);
      	$friendSchoolName= $schoolInfo['name'];

		echo "<p>";
	    echo $friendName."<br>";
		echo $friendSchoolName;
    	echo "</p>";
	}
      ?>
          
        </h1>
      </div>
      <div id="about_sec" style="display:none;">
        <h1>
About        </h1>
      </div>  
      <div id="other_sec" style="display:none;">
        <h1>
Other
        </h1>
      </div>
    </div>
  </div>
</body>
</html>
