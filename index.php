<?php
ob_start();
require_once('includes/load.php');

// Disable browser back button on admin.php
if ($session->isUserLoggedIn(true)) { redirect('admin.php', false); }
?>

<?php include_once('layouts/header.php'); ?>

<script src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v10.0&appId=YOUR_APP_ID&autoLogAppEvents=1" nonce="YOUR_NONCE_VALUE"></script>

<style>
  body {
    background-color: #DDDDDD;
    display: center; /* Change display to flex */
    justify-content: center;
    align-items: center;
    height: 100vh;
  }

  .login-page {
    width: 490px;
    margin: 1 auto;
    border: 1px solid;
    border-radius: 5px;
    border-color: #567189;
    height: auto;
    min-height: 380px;
  }

  .login-page.with-message {
    min-height: 450px;
  }
</style>

<div class="login-page<?php echo !empty($msg) ? ' with-message' : ''; ?>">
  <div class="text-center">
    <h3 style="color: #666666;">Login</h3>
  </div>
  <?php echo display_msg($msg); ?>
  <form method="post" action="auth.php" class="clearfix">
    <div class="form-group">
      <label style="color: #7f7f7f;" for="name">Username</label>
      <div class="input-group">
        <span class="input-group-addon"><i class="fas fa-user" style="color: #666666;"></i></span>
        <input type="text" class="form-control" name="username" placeholder="Username" data-toggle="tooltip" data-placement="bottom" title="Input username">
      </div>
    </div>

    <div class="form-group">
      <label style="color: #7f7f7f;" for="name">Password</label>
      <div class="input-group">
        <span class="input-group-addon"><i class="fas fa-lock" style="color: #666666;"></i></span>
        <input type="password" name="password" class="form-control" placeholder="Password" data-toggle="tooltip" data-placement="bottom" title="Input password">
      </div>
    </div>

    <div class="form-group">
      <div class="checkbox">
        <label style="color: #666666;">
          <input type="checkbox" name="remember"> Remember me
        </label>
      </div>
    </div>

    <div class="form-group clearfix">
      <button type="submit" class="btn custom-primary-btn btn-block" style="border-radius: 5px%;" data-toggle="tooltip" data-placement="bottom" title="Login">Login</button>
    </div>
  </form>

  <div class="text-center">
    <p style="color: #666666;">Or</p>
  </div>

  <div class="row">
    <div class="col-md-6">
      <!-- Facebook login button with icon -->
      <button onclick="loginWithFacebook()" class="btn btn-block custom-primary-btn">
        <i class="fab fa-facebook"></i> Login with Facebook
      </button>
    </div>
    <div class="col-md-6">
      <!-- Gmail login button with icon -->
      <button onclick="loginWithGmail()" class="btn btn-block custom-primary-btn">
        <i class="fab fa-google"></i> Login with Gmail
      </button>
    </div>
  </div>
</div>

<?php
if (isset($_POST['remember'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Check if the provided username and password are valid
  if (valid_username_password($username, $password)) {
    // Set a cookie to remember the user
    $cookie_name = "remember";
    $cookie_value = $username;
    $cookie_expiration = time() + (2 * 24 * 60 * 60); // Cookie valid for 2 days
    setcookie($cookie_name, $cookie_value, $cookie_expiration, '/');
  }
}
?>

<?php
function valid_username_password($username, $password) {
  // Define the valid usernames and passwords
  $valid_accounts = array(
    'admin' => 'admin',
    'employee' => 'employee'
  );

  // Check if the provided username exists and the password matches
  if (isset($valid_accounts[$username]) && $valid_accounts[$username] === $password) {
    return true;
  }

  return false;
}
?>

<script>
  function loginWithFacebook() {
    // Implement Facebook OAuth login functionality here
    // Initialize the Facebook SDK
  FB.init({
    appId: 'YOUR_APP_ID',
    cookie: true,
    xfbml: true,
    version: 'v10.0'
  });

  // Check the login status
  FB.getLoginStatus(function(response) {
    if (response.status === 'connected') {
      // User is already logged in with Facebook
      // Perform any necessary actions or redirect the user
    } else {
      // User is not logged in with Facebook
      // Trigger the Facebook login dialog
      FB.login(function(response) {
        if (response.authResponse) {
          // User successfully logged in with Facebook
          // Access the user's access token and perform any necessary actions or redirect the user
        } else {
          // User cancelled the Facebook login dialog or an error occurred
          // Handle the error or perform any necessary actions
        }
      }, { scope: 'email' }); // Specify the permissions you need for your app
    }
  });
  }

  function loginWithGmail() {
    // Implement Gmail OAuth login functionality here
  }
</script>
