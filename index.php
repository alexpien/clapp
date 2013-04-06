<!DOCTYPE html>
<html>
<head>
  <title>
    Clapp
  </title>
  <link rel="stylesheet" href="stylesheets/styles.css" type="text/css">
  <link rel="stylesheet" href="stylesheets/fonts.css" type="text/css">
  <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>

</head>
<body>

<div id="fb-root"></div>
<script>
function login() {
    FB.login(function(response) {
        if (response.authResponse) {
            // connected
              testAPI();
        } else {
            // cancelled
        }
    });
}

function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
        console.log('Good to see you, ' + response.name + '.');
    });
}

  // Additional JS functions here
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '334873059942972', // App ID
      channelUrl : '//blooming-reef-3850.herokuapp.com/channel.html', // Channel File
      status     : true, // check login status
      cookie     : true, // enable cookies to allow the server to accdess the session
      xfbml      : true  // parse XFBML
    });

    FB.getLoginStatus(function(response) {
  if (response.status === 'connected') {
    // connected
  } else if (response.status === 'not_authorized') {
    // not_authorized
      login();
  } else {
    // not_logged_in
      login();
  }
 });

  };

  // Load the SDK Asynchronously
  (function(d){
     var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement('script'); js.id = id; js.async = true;
     js.src = "//connect.facebook.net/en_US/all.js";
     ref.parentNode.insertBefore(js, ref);
   }(document));
</script>
  <div id="wrapper">
    <header>
      <div id="logo">
        <h1>clapp</h1>
      </div>
      <div id="nav">
        <a href="#classes">classes<a>
        <a href"#friends">friends<a>
        <a href="#about">about</a>
      </div>
    </header>
    <h1>
      hello
    </h1>

  <div class="list">
        <h3>A few of your friends</h3>
        <ul class="friends">
          <?php
            foreach ($friends as $friend) {
              // Extract the pieces of info we need from the requests above
              $id = idx($friend, 'id');
              $name = idx($friend, 'name');
          ?>
          <li>
            <a href="https://www.facebook.com/<?php echo he($id); ?>" target="_top">
              <img src="https://graph.facebook.com/<?php echo he($id) ?>/picture?type=square" alt="<?php echo he($name); ?>">
              <?php echo he($name); ?>
            </a>
          </li>
          <?php
            }
          ?>
        </ul>
      </div>

</body>
</html>
