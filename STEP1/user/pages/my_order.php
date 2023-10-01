<?php
$include_sidebar = false;
$order_id = $_GET['id'];
$order_manager = new OrderManager();
$order_item_manager = new OrderItemManager();
$product_manager = new ProductManager();
$supplier_manager = new SupplierManager();
$category_manager = new CategoryManager();
$order = $order_manager->get($order_id);
$order_items = $order_item_manager->get_orders_item($order_id);
?>
<h3>
    Ordine N°<?php echo $order->id?>
</h3>
<div class="accordion" id="accordionExample">
    <?php foreach($order_items as $order_item) { 
        $product = $product_manager->get($order_item->product_id);
        $supplier = $supplier_manager->get($product->supplier_id);
        $category = $category_manager->get($product->category_id);
        ?>

        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                    aria-expanded="true" aria-controls="collapseOne">
                    <?php echo $product->name ?>
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                data-bs-parent="#accordionExample" style="">
                <div class="accordion-body">
                    <strong>Descrizione: <?php echo $product->description ?></strong>
                </div>
            </div>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                data-bs-parent="#accordionExample" style="">
                <div class="accordion-body">
                    <strong>Prezzo: <?php echo $product->price ?></strong>
                    <strong>Quantità: <?php echo $order_item->quantity ?></strong>
                </div>
            </div>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                data-bs-parent="#accordionExample" style="">
                <div class="accordion-body">
                    <strong>Prezzo totale: <?php echo $product->price * $order_item->quantity  ?>€</strong>
                </div>
            </div>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                data-bs-parent="#accordionExample" style="">
                <div class="accordion-body">
                    <strong>Marca: <?php echo $supplier->name ?></strong>
                </div>
            </div>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                data-bs-parent="#accordionExample" style="">
                <div class="accordion-body">
                    <strong>Materiale: <?php echo $category->name ?></strong>
            </div>
            </div>
        </div>
    <?php }?>
    <h2 class="accordion-header" id="headingTwo">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            Spedizione
        </button>
    </h2>
    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
        data-bs-parent="#accordionExample" style="">
        <div class="accordion-body">
            <h6>Indirizzo:</h6> <?php echo $order->shipping_address?>
        </div>
        <div class="accordion-body">
            <h6>Nazione:</h6> <?php echo $order->country?>
        </div>
        <div class="accordion-body">
            <h6>Provincia:</h6> <?php echo $order->province?>
        </div>
        <div class="accordion-body">
            <h6>Citta:</h6> <?php echo $order->city?>
        </div>
        <div class="accordion-body">
            <h6>Cap:</h6> <?php echo $order->zip?>
        </div>
    </div>
</div>