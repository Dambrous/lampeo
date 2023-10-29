<div class="col-3">
    <?php

    $productManager = new ProductManager();
    $products = $productManager->getAll();
    $firstFourProducts = array_slice($products, 0, 4);
    foreach($firstFourProducts as $product) {?>
        <div class="card">
            <img src="../back-end/db_images/<?php echo $product->image ?>" class="card-img-top" alt="IMG">
            <div class="card-body">
                <h5 class="card-title"><?php echo $product->name?></h5>
                <p class="card-text"><?php echo $product->description?></p>
                <a href="#<?php echo $product->id?>" class="btn btn-primary" onclick="location.href='<?php echo ROOT_URL . '?page=product&id=' . ($product->id); ?>'">Acquista Ora</a>
            </div>
        </div>
    <?php }?>
</div>
