<?php
$include_sidebar = false;
$exclude_logo_header = True;
if ($logged_in_user) {
  echo '<script>location.href="'.ROOT_URL.'?page=homepage"</script>';
  exit; 
}
if (isset($_POST['login'])){
  $email = $_POST['email'];
  $password = $_POST['password'];
  $user_manager = new UserManager();
  $result = $user_manager->login($email, $password);
  if ($result) {
    echo '<script>location.href="'.ROOT_URL.'user?page=profile"</script>';
    exit;
  } else {
    $error_message = 'Inserisci credenziali corrette';
    echo'<div class="alert alert-danger" id="error-message" style="display: block;">'.$error_message.'</div>';
  }
}
?>
<form class="mb-4" method="post">
    <!-- <img class="mb-4" src="<?php echo ROOT_PATH?>front-end/assets/imgs/icons8-lampada-96.png" alt="" width="72" height="57">-->
    <div class="form-floating">
      <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com" required="">
      <label for="floatingInput">Email address</label>
    </div>
    <div class="form-floating">
      <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required="">
      <label for="floatingPassword">Password</label>
    </div>

    <div class="form-check text-start my-3">
      <input name="remember_me" class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
      <label class="form-check-label" for="flexCheckDefault">
        Remember me
      </label>
    </div>

    <div id="error-message" class="alert alert-danger" style="display: none;"></div>

    <button class="btn btn-primary w-100 py-2" name="login" type="submit">Log In</button>
</form>