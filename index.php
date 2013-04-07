<?php

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Clapp</title>
    <link rel="stylesheet" href="stylesheets/styles.css" type="text/css">
    <link rel="stylesheet" href="stylesheets/fonts.css" type="text/css">
    <link rel="Shortcut Icon" href="images/favicon.ico">
    <link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
    <script type="text/javascript" src="javascript/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="javascript/script.js"></script>
  </head>
  
  <body>

    <div id="fb-root"></div>
    <script>


  // Load the SDK Asynchronously
    (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=358797270908365";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

  </script>

 
  <div class="fb-login-button" data-show-faces="true" data-width="200" data-max-rows="1" >Login with Facebook</div>
  <button type="button" onclick="testAPI()">Test API</button>
  <div id="top">
  </div>
  <div id="wrapper">
    <div id="header">
      <div id="logo">
        <a href="#home">
        <img href="images/icone.png"/><<h1>cla<span style="color:#333;">pp</span></h1>
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
          Welcome to Clapp. Login to facebook to get started.
        </h1>
      </div>
      <div id="classes_sec" style="display:none;">
        <h1>
          Welcome to Clapp2. Login to facebook to get started.
        </h1>
      </div>
      <div id="friends_sec" style="display:none;">
        <h1>
          Welcome to Clapp3. Login to facebook to get started.
        </h1>
      </div>
      <div id="about_sec" style="display:none;">
        <h1>
          Welcome to Clapp4. Login to facebook to get started.
        </h1>
      </div>  
      <div id="other_sec" style="display:none;">
        <h1>
          Welcome to Clapp5. Login to facebook to get started.
        </h1>
      </div>
    </div>
  </div>
</body>
</html>
