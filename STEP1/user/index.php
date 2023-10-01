<?php
require_once '../../inc/init.php'; 
$include_sidebar = true;
$include_footer = false;

//if (!$loggedInUser) {
//  $returnPage = isset($_GET['page']) ? $_GET['page'] : '';
//  echo "<script>location.href='".ROOT_URL."auth?page=login'</script>";
//  exit;
//}

// if ($_GET['page'] == 'dashboard' && $loggedInUser->user_type == 'admin') {
//   echo "<script>location.href='".ROOT_URL."admin?page=dashboard'</script>";
//   exit;
// }
$page = isset($_GET["page"]) ? $_GET["page"] : 'homepage';
$page = 'login';
if(isset($_GET['page'])) {
  $page = $_GET['page'];
}
?>
<?php include ROOT_PATH . 'STEP1/public/template-parts/header.php'; ?>
<div id="main" class="container" style="margin-top:50px;">
    <div class="row">
        <?php include ROOT_PATH . 'STEP1/user/pages/' . $page . '.php'?>
        <?php if ($include_sidebar) { ?>
            <?php include ROOT_PATH . 'STEP1/public/template-parts/sidebar.php'?>
        <?php } ?>
    </div>
</div>
<?php if ($include_footer) {
    include  ROOT_PATH . 'STEP1/public/template-parts/footer.php' ?>
<?php } ?>

            
    <script src="https://bootswatch.com/_vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://bootswatch.com/_vendor/prismjs/prism.js"></script>
    <script src="<?php echo ROOT_PATH; ?>STEP1/assets/js/main.js"></script>
</body>
</html>