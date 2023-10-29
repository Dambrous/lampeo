<?php
$include_sidebar = false;
$product_manager = new ProductManager();
if (isset($_GET['search'])){ ?>
    <div class="container">
        <div class="row">
            <?php
            $products_ids = $product_manager->get_product_like_search($_GET['search']);

            foreach($products_ids as $product) {?>
                <div class="col-12 col-md-6 col-lg-4 mb-5">
                    <div class="card mb-4" href="#<?php echo $product->id?>" onclick="location.href='<?php echo ROOT_URL . '?page=product&id=' . ($product->id); ?>'">
                        <img src="../back-end/db_images/<?php echo $product->image ?>" class="card-img-top" alt="IMG">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $product->name?></h5>
                            <p class="card-text"><?php echo $product->description?></p>
                            <a class="btn btn-primary">Acquista Ora</a>
                        </div>
                    </div>
                </div>
            <?php }?>
        </div>
    </div>
<?php } else { ?>
    <div class="container">
        <div class="row">
            <?php

            $products_ids = $product_manager->getAll();
        
            foreach($products_ids as $product) {?>
                <div class="col-12 col-md-6 col-lg-4 mb-5">
                    <div class="card mb-4" href="#<?php echo $product->id?>" onclick="location.href='<?php echo ROOT_URL . '?page=product&id=' . ($product->id); ?>'">
                        <img src="../back-end/db_images/<?php echo $product->image ?>" class="card-img-top" alt="IMG">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $product->name?></h5>
                            <p class="card-text"><?php echo $product->description?></p>
                            <a class="btn btn-primary">Acquista Ora</a>
                        </div>
                    </div>
                </div>
            <?php }?>
        </div>
    </div>
<?php }?>
