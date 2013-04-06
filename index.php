<!DOCTYPE html>
<html>
  <head>
    <title>Clapp</title>
    <link rel="stylesheet" href="stylesheets/styles.css" type="text/css">
    <link rel="stylesheet" href="stylesheets/fonts.css" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
  </head>
  
  <body>

    <div id="fb-root"></div>
    <script>

//run this at load time
    function displayInfo() {
      FB.api('/me', function(response) {
      	document.getElementById("displayInfo").innerHTML='Good to see you, ' + response.name + '.'
        	+'You are from ' + response.hometown.name + '.'
        	+'You go to ' + response.education[response.education.length-1].school.name + '.';

    });
  }


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

  <p id="displayInfo">

  </p>
  <div id="top">
  </div>
  <div id="wrapper">
    <div id="header">
      <div id="logo">
        <h1>cla<span style="color:#333;">pp</span></h1>
      </div>
      <div id="nav">
        <a href="#classes">classes</a>
        <a href="#friends">friends</a>
        <a href="#about">about</a>
        <a href="#other">other</a>
      </div>
    </div>
    <div id="#home_sec" style="display:none;">
      <h1>
        Welcome to Clapp. Login to facebook to get started.
      </h1>
    </div>
    <div id="#classes_sec" style="display:none;">
      <h1>
        Welcome to Clapp2. Login to facebook to get started.
      </h1>
    </div>
    <div id="#friends_sec" style="display:none;">
      <h1>
        Welcome to Clapp3. Login to facebook to get started.
      </h1>
    </div>
    <div id="#about_sec" style="display:none;">
      <h1>
        Welcome to Clapp4. Login to facebook to get started.
      </h1>
    </div>
    <div id="#other_sec" style="display:none;">
      <h1>
        Welcome to Clapp5. Login to facebook to get started.
      </h1>
    </div>
  </div>
</body>
</html>
