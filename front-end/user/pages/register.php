<?php
$include_sidebar = false;
$include_footer = false;
//if ($logged_in_user) {
//  echo '<script>location.href="'.ROOT_URL.'?page=homepage"</script>';
//  exit; 
//}
if (isset($_POST['register'])){
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $user_manager = new UserManager();
    // return true if user already exist with selected email
    $result = $user_manager->check_user_exists_by_email($email);
    if ($result) {
        //error message
        echo '<script>location.href="'.ROOT_URL.'user?page=profile"</script>';
        exit;
    }
    $user_manager->create([
        'name' => $name,
        'surname' => $surname,
        'email' => $email,
        'password' => $password,
        'user_type_id' => 1]);
    $user_manager->login($email, $password);
    //$_SESSION['user'] = $user;
    echo '<script>location.href="'.ROOT_URL.'user?page=profile"</script>';
    exit; 
}
?>
<form class="mb-4" method="post">
    <h3>Compila con i tuoi dati</h3>
    <!-- <img class="mb-4" src="<?php echo ROOT_PATH?>front-end/assets/imgs/icons8-lampada-96.png" alt="" width="72" height="57">-->
    <div class="form-floating">
      <input type="name" name="name" class="form-control" id="floatingInput" placeholder="Luca" required="">
      <label for="floatingInput">Nome</label>
    </div>
    <div class="form-floating">
      <input type="surname" name="surname" class="form-control" id="floatingInput" placeholder="D'Ambrosio" required="">
      <label for="floatingInput">Cognome</label>
    </div>
    <div class="form-floating">
      <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com" required="">
      <label for="floatingInput">Indirizzo email</label>
    </div>
    <div class="form-floating">
      <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required="">
      <label for="floatingPassword">Password</label>
      <input type="hidden" name="user_type" value="1"></input>
    </div>

    <div id="error-message" class="alert alert-danger" style="display: none;"></div>

    <button class="btn btn-primary w-100 py-2 mt-5" name="register" type="submit">Registrati</button>
</form>