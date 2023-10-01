<?php
$include_sidebar = false;
$cart_manager = new CartManager();
$product_manager = new ProductManager();
$cart_id = $cart_manager->get_current_cart_id();
$total = 0;

if (isset($_POST['minus'])) {
    $cart_item_id = $_POST['id'];
    $cart_manager->update_quantity($cart_item_id, $operand = "-");

}

if (isset($_POST['plus'])) {
    $cart_item_id = $_POST['id'];
    $cart_manager->update_quantity($cart_item_id, $operand = "+");
}

if (isset($_POST['checkout'])) {
    if (isset($logged_in_user)){
        echo '<script>location.href="'.ROOT_URL.'user?page=checkout"</script>';
    } else {
        echo '<script>alert("Per procedere devi registrarti o fare login.");</script>;';
    }
}

$cart_total = $cart_manager->get_cart_total($cart_id);
$cart_items = $cart_manager->get_cart_items($cart_id);

?>
<div class="col-12 order-md-last mt-4 pb-5">
    <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-primary">Carrello</span>
        <span class="badge bg-primary rounded-pill"><?php echo count($cart_items) ?></span>
    </h4>
    <?php if(count($cart_items)> 0){?>
        <ul class="list-group mb-3" style="text-align: center">
        <?php
        foreach($cart_items as $cart_item) {
            $product = $product_manager->get($cart_item['product_id']);
            $total = $total + ($product->price * $cart_item['quantity']);?>
            <li class="list-group-item d-flex justify-content-between lh-sm p-4">
            <div class="row w-100">
                <div class="col-lg-4 col-6">
                    <div class="row">
                        <div class="col-lg-6 col-6 d-none d-md-block">
                            <img src="../STEP2/db_images/<?php echo $product->image ?>" width="140" height="140" alt="IMG">
                        </div>
                        <div class="col-lg-6 col-12">
                            <h6 class="my-0"></h6>
                            <strong>
                                <?php echo $product->description ?>
                            </strong>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-6">
                    <span class="text-muted">€
                    <?php echo $product->price ?>
                    </span>
                </div>
                <div class="col-lg-4 col-6">
                    <form method="post">
                        <div class="cart-buttons btn-group justify-content-center align-items-center" role="group" style="border: 1px solid;">
                            <button name="minus" type="submit" class="btn btn-sm btn-primary">-</button>
                            <span class="text-muted align-middle"><?php echo $cart_item['quantity']?></span>
                            <button name="plus" type="submit" class="btn btn-sm btn-primary">+</button>
                            <input type="hidden" name="id" value="<?php echo $cart_item['id']?>"></input>
                            <!-- <input type="hidden" name="product_id" value="<?php echo $product->id; ?>"> -->
                        </div>
                    </form>
                </div>
                <div class="col-lg-2 col-6">
                    <strong class="text-primary">€<?php echo $product->price * $cart_item['quantity']?></strong>
                </div>
            </div>
            </li>
        <?php } ?>

        <li class="list-group-item d-flex justify-content-between p-4">
            <div class="row w-100">
                <div class="col-lg-4 col-6">
                    <span>Totale</span>
                </div>
                <div class="col-lg-6 lg-screen"></div>
                <div class="col-lg-2 col-6">
                    <strong>€<?php echo $total ;?></strong>
                </div>
            </div>
        </li>
    </ul>

    <hr>
    <form method="post">
        <button class="btn btn-primary btn btn-primary btn-block w-100 mt-5" type="submit" name="checkout">Checkout</button>
    </form>
    <?php } else {?>
        <p class="lead">Nessun elemento nel carrello...</p>
        <a href="#<?php ROOT_PATH . 'STEP1/public/pages/product_list.php'?>" class="btn btn-primary" onclick="location.href='<?php echo ROOT_URL . '?page=product_list';?>'">Torna a fare acquisti</a>
    <?php }?>
</div>
