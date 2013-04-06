<?php
/*
require_once('AppInfo.php');
require_once('utils.php');

require_once('sdk/src/facebook.php');

$facebook = new Facebook(array(
  'appId'  => AppInfo::appID(),
  'secret' => AppInfo::appSecret(),
  'sharedSession' => true,
  'trustForwarded' => true,
));
$user_id = $facebook->getUser();
  $likes = idx($facebook->api('/me/likes'), 'data', array());
  $friends = idx($facebook->api('/me/friends'), 'data', array());
  $photos = idx($facebook->api('/me/photos'), 'data', array());
  */
  ?>



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
  <div id = "wrapper">
  <header>
    <div id="logo">
      CLAPP
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

       <div class="list">
        <h3>Things you like</h3>
        <ul class="things">
          <?php
            foreach ($likes as $like) {
              // Extract the pieces of info we need from the requests above
              $id = idx($like, 'id');
              $item = idx($like, 'name');

              // This display's the object that the user liked as a link to
              // that object's page.
          ?>
          <li>
            <a href="https://www.facebook.com/<?php echo he($id); ?>" target="_top">
              <img src="https://graph.facebook.com/<?php echo he($id) ?>/picture?type=square" alt="<?php echo he($item); ?>">
              <?php echo he($item); ?>
            </a>
          </li>
          <?php
            }
          ?>
        </ul>
      </div>
    </div>

</body>
</html>
