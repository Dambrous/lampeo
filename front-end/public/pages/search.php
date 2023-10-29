<?php
$include_sidebar = false;
if (isset($_POST['search'])) {
    echo $_POST['minus'];
    $cart_id = $_POST['cart_id'];
    $product_id = $_POST['product_id'];
    $cart_manager->remove_from_cart($product_id, $cart_id);
}


?>

<div class="container">
    <div class="row">
        <?php

        $productManager = new ProductManager();
        $products = $productManager->getAll();
    
        foreach($products as $product) {?>
            <div class="col-4">
                <div class="card mb-4">
                    <img src="../back-end/db_images/<?php echo $product->image ?>" class="card-img-top" alt="IMG">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $product->name?></h5>
                        <p class="card-text"><?php echo $product->description?></p>
                        <a href="#<?php echo $product->id?>" class="btn btn-primary" onclick="location.href='<?php echo ROOT_URL . '?page=product&id=' . ($product->id); ?>'">Acquista Ora</a>
                    </div>
                </div>
            </div>
        <?php }?>
    </div>
</div>