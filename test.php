// Provides access to app specific values such as your app id and app secret.
// Defined in 'AppInfo.php'
require_once('AppInfo.php');

// This provides access to helper functions defined in 'utils.php'
require_once('utils.php');

require_once('sdk/src/facebook.php');

$facebook = new Facebook(array(
  'appId'  => AppInfo::appID(),
  'secret' => AppInfo::appSecret(),
  'sharedSession' => false,
  'trustForwarded' => false,
));

$user_id = $facebook->getUser();


  // This fetches some things that you like . 'limit=*" only returns * values.
  // To see the format of the data you are retrieving, use the "Graph API
  // Explorer" which is at https://developers.facebook.com/tools/explorer/
  $likes = idx($facebook->api('/me/likes'), 'data', array());
  $friends = idx($facebook->api('/me/friends'), 'data', array());
  $photos = idx($facebook->api('/me/photos'), 'data', array());
  
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