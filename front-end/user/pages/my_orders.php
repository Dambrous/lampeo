<?php
$include_sidebar = false;
$om = new OrderManager();
$oim = new OrderItemManager();
$pm = new ProductManager();
$orders = $om->get_orders($logged_in_user->id);
?>
<div class="col-12 order-md-last mt-4 pb-5">
    <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-primary">Lista Ordini Effettuati</span>
        <span class="badge bg-primary rounded-pill"><?php echo count($orders) ?></span>
    </h4>
    <?php if (count($orders)>0){?>
    <div class="list-group">
        <?php foreach($orders as $sale_order){
            $total = 0;
            $order_items = $oim->get_orders_item($sale_order->id); ?>
            <a href="#<?php echo $sale_order->id?>" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true" onclick="location.href='<?php echo ROOT_URL . 'user/?page=my_order&id=' . ($sale_order->id); ?>'">
                <img src="../../front-end/assets/imgs/icons8lampada96.png" alt="logo" width="32" height="32" class="rounded-circle flex-shrink-0">
                <div class="d-flex gap-2 w-100 justify-content-between">
                    <div>
                        <h6 class="mb-0">id Ordine: <?php echo $sale_order->id ?></h6>
                        <?php foreach($order_items as $item){ 
                            $product = $pm->get($item->product_id);
                            $total += $product->price * $item->quantity?>
                            <p class="mb-0 opacity-75"><strong>Prodotto: </strong><?php echo $product->name ?></p>
                            <p class="mb-0 opacity-75">Prezzo: <?php echo $product->price ?></p>
                            <p class="mb-0 opacity-75">Quantità: <?php echo $item->quantity ?></p>
                            <hr></hr>
                        <?php }?>
                    </div>
                    <li class="list-group-item list-group-item-info d-flex justify-content-between align-items-center">
                        Data Ordine: <?php echo $sale_order->date_order ?>
                    </li>
                    <li class="list-group-item list-group-item-info d-flex justify-content-between align-items-center">
                        Totale: <?php echo number_format($total, 2) ?>
                    </li>
                </div>
            </a>
        <?php }?>
    
    </div>
    <?php } else {?>
    <p class="lead">Nessun ordine effettuato...</p>
    <a href="#<?php ROOT_PATH . 'front-end/public/pages/product_list.php'?>" class="btn btn-primary" onclick="location.href='<?php echo ROOT_URL . '?page=product_list';?>'">Vai ai prodotti</a>
</div>
<?php }?>