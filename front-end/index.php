<?php
require_once '../configurations/init.php'; 
$include_sidebar = false;
$include_footer = false;
$page = isset($_GET["page"]) ? $_GET["page"] : 'homepage';
$page = 'login';
if(isset($_GET['page'])) {
  $page = $_GET['page'];
}
?>
<?php include ROOT_PATH . 'front-end/public/template-parts/header.php'; ?>
<div id="main" class="container" style="margin-top:50px;">
    <div class="row">
        <?php include ROOT_PATH . 'front-end/public/pages/' . $page . '.php'?>
        <?php if ($include_sidebar) { ?>
            <?php include ROOT_PATH . 'front-end/public/template-parts/sidebar.php'?>
        <?php } ?>
    </div>
</div>
<?php if ($include_footer) {
    include  ROOT_PATH . 'front-end/public/template-parts/footer.php' ?>
<?php } ?>

            
    <script src="https://bootswatch.com/_vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://bootswatch.com/_vendor/prismjs/prism.js"></script>
    <script src="<?php echo ROOT_PATH; ?>front-end/assets/js/main.js"></script>
</body>
</html>