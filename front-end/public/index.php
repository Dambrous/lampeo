<?php
require_once '../../configurations/init.php'; 
global $loggedInUser;

$page = isset($_GET["page"]) ? $_GET["page"] : 'homepage';
echo '<script>location.href="'.ROOT_URL.'?page='.$page.'"</script>';
exit;
?>