<?php
$include_sidebar = false;

if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['id'];
    $cart_manager = new CartManager();
    $product_manager = new ProductManager();
    $cart_id = $cart_manager->get_current_cart_id();
    $product = $product_manager->get($product_id);
    //aggiungi al carrello "cart_id" il prodotto "product_id"
    $cart_manager->add_to_cart($product_id, $cart_id);
    echo '  <script>alert("Il prodotto '.$product->name.' è stato aggiunto al carrello.");</script>;';
    echo '  <script>location.href="'.ROOT_URL.'?page=product&id=' . $product_id . '"</script>';
    exit;
}
?>
<section class="py-5">
    <div class="container" >
        <div class="row">
        <?php
        $include_sidebar = false;
        $page = isset($_GET["page"]) ? $_GET["page"] : 'homepage';
        $product_id = isset($_GET["id"]) ? $_GET["id"] : 'product';
        $product_manager = new ProductManager();
        $product = $product_manager->get($product_id);
        ?>
            <div class="col-md-6">
                <div class="card mb-4">
                    <img src="../back-end/db_images/<?php echo $product->image ?>" class="card-img-top" alt="IMG">
                </div>
            </div>


            <div class="col-md-6">
                <h1 class="fw-bolder mt-4"><?php echo $product->name ?></h1>
                <div class="fs-5 mb-5">
                    <span class="text-decoration-line-through"><?php echo $product->price ?>€</span>
                    <span class=""><?php echo number_format($product->price / 2, 2) ?>€</span>
                </div>
                <p class="lead">
                    <?php echo $product->description ?>
                </p>
                <div class="d-flex">
                    <form method="post">
                        <input name="id" type="hidden" value="<?php echo $product->id; ?>">
                        <input name="add_to_cart" type="submit" class="btn btn-primary right" value="Aggiungi al carrello">
                    </form>   
                    
                </div>
            </div>
        </div>
    </div>
</section>
<section class="py-5 bg-light">
    <div class="container" >
        <div class="row">
            <h2 class="fw-bolder mb-4">Prodotti Correlati</h2>
            <?php

            $product_manager = new ProductManager();
            $product_ids = $product_manager->getAll();
            $count = 0;
            foreach($product_ids as $product) {
                if ($count >= 3) {
                    break;
                }?>
                <div class="col-4 ">
                    <div class="card mb-4">
                        <img src="../back-end/db_images/<?php echo $product->image ?>" class="card-img-top" alt="IMG">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $product->name?></h5>
                            <p class="card-text"><?php echo $product->description?></p>
                            <a href="#<?php echo $product->id?>" class="btn btn-primary" onclick="location.href='<?php echo ROOT_URL . '?page=product&id=' . ($product->id); ?>'">Acquista Ora</a>
                        </div>
                    </div>
                </div>
            <?php $count++; }?>
        </div>
    </div>
</section>
