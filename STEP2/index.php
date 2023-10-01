<?php
require_once '../inc/init.php'; 
global $loggedInUser;

$page = isset($_GET["page"]) ? $_GET["page"] : 'homepage';
echo '<script>location.href="'.ROOT_URL.'?page='.$page.'"</script>';
exit;
?>