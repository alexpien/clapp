<!DOCTYPE html>
<html>
<head>
  <title>
    Clapp
  </title>
  <link rel="stylesheet" href="stylesheets/styles.css" type="text/css">
  <link type='text/css' rel='stylesheet' href='http://fonts.googleapis.com/css?family=Lobster|Merriweather+Sans:800'/>

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
      appId      : 'APPID', // App ID
      status     : true, // check login status
      cookie     : true, // enable cookies to allow the server to access the session
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

  <header>
    <div id="logo">
      CLAPP
    </div>

  </header>
  <h1>
    hello
  </h1>

</body>
</html>
