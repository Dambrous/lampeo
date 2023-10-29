<?php
$cart_manager = new CartManager();
$productManager = new ProductManager();
$cart_id = $cart_manager->get_current_cart_id();
$cart_items = $cart_manager->get_cart_items($cart_id);
$products_searched = 0;
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0");

if (isset($_POST['search'])) {
    if ($_POST['string_search'] != "") {
        $products_searched = $productManager->get_product_like_search($_POST['string_search']);
        if (count($products_searched)>0){
            echo '<script>location.href="'.ROOT_URL.'?page=product_list&search='.$_POST['string_search'].'"</script>';
            exit;
        } else {
            echo '<div class="alert alert-danger">Nessun prodotto trovato.</div>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://bootswatch.com/5/lux/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo ROOT_URL ?>/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Lampeo Ecommerce</title>
</head>
<body id="body_main">
    <nav class="navbar navbar-expand-lg bg-body-tertiary " data-bs-theme="dark">
        <div class="container-fluid">
            <img src="../front-end/assets/imgs/icons8lampada96.png" width="40" height="30" class="d-inline-block align-text-top" alt="Lampeo">
            <a class="navbar-brand" href="<?php echo ROOT_URL; ?>?page=homepage">LAMPEO</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo ROOT_URL; ?>?page=product_list">Prodotti</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo ROOT_URL; ?>?page=contacts">Contatti</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo ROOT_URL; ?>?page=about">Chi siamo</a>
                    </li>
                </ul>

                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="<?php echo ROOT_URL ?>?page=cart">
                            <i class="fas fa-shopping-cart nav-link">
                                <span class="badge badge-success rounded-pill text-bg-success "><?php echo count($cart_items) ?></span>
                            </i>
                        </a>
                    </li>
                </ul>
                <form class="d-flex" role="search" method="post">
                    <input name="string_search" type="text" class="form-control me-2 bg-dark text-white" placeholder="Lampada ..." aria-label="Search">
                    <button class="btn btn-outline-success" name="search" type="submit">Cerca</button>
                </form>
                <div id="search-error-message" class="text-danger"></div>
                <?php if (!$logged_in_user){ ?>
                    <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Area Riservata</a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="<?php echo ROOT_URL ?>/user?page=login">Login</a>
                            <a class="dropdown-item" href="<?php echo ROOT_URL ?>/user?page=register">Registrati</a>
                            <hr class="dropdown-divider">
                            </div>
                        </li>
                    </ul>
                    <?php } else {?>
                    <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?php echo $logged_in_user->email ?>
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="<?php echo ROOT_URL ?>/user?page=profile">Profilo</a>
                                <a class="dropdown-item" href="<?php echo ROOT_URL ?>/user?page=my_orders">Ordini</a>
                                <?php if ($logged_in_user->is_admin){ ?>
                                    <a class="dropdown-item" href="<?php echo ROOT_URL ?>?page=upload_product">Aggiungi Prodotti</a>
                                <?php } ?>
                                <hr class="dropdown-divider">
                                <a class="dropdown-item" href="<?php echo ROOT_URL ?>/user?page=logout">Logout</a>
                            </div>
                        </li>
                    </ul>
                <?php } ?>



                
            </div>
        </div>
    </nav>
