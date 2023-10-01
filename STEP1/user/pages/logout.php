<?php

unset($_SESSION['user']);

echo '<script>location.href="'.ROOT_URL.'user?page=login"</script>';
exit;

?>