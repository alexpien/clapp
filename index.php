<!DOCTYPE html>
<html>
<head>
  <title>
    Clapp
  </title>
  <link rel="stylesheet" href="stylesheets/styles.css" type="text/css">
  <link rel="stylesheet" href="stylesheets/fonts.css" type="text/css">
  <link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>

</head>
<body>

<div id="fb-root"></div>
<script>

function testAPI() {
    FB.api('/me', function(response) {
        alert('Good to see you, ' + response.name + '.');
    });
  }

  // Additional JS functions here
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '358797270908365', // App ID
      channelUrl : '//blooming-reef-3850.herokuapp.com/channel.html', // Channel File
      status     : true, // check login status
      cookie     : true, // enable cookies to allow the server to accdess the session
      xfbml      : true  // parse XFBML
    });

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

<div class="fb-login-button" data-show-faces="true" data-width="200" data-max-rows="1">Login with Facebook</div>
 <button type="button" onclick="testAPI()">Test API</button>

  <div id="wrapper">
    <div id="header">
      <div id="logo">
        <h1>clapp</h1>
      </div>
      <div id="nav">
        <a href="#classes">classes</a>
        <a href="#friends">friends</a>
        <a href="#about">about</a>
        <a href="#other">other</a>
      </div>
    </div>
    <h1>
      hello
    </h1>

</body>
</html>
