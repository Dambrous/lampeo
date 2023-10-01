<?php
$include_sidebar = false;
$include_footer = false;
$cart_manager = new CartManager();
$product_manager = new ProductManager();
$order_manager = new OrderManager();
$order_item_manager = new OrderItemManager();
$cart_id = $cart_manager->get_current_cart_id();
$cart_total = $cart_manager->get_cart_total($cart_id);
$cart_items = $cart_manager->get_cart_items($cart_id);
$country_manager = new CountryManager();
$province_manager = new ProvinceManager();
$total = 0;
$dateToday = date('Y-m-d H:i:s');
if (isset($_POST['buy_now'])){
    if ($_POST['buy_now'] !== ""){
        $_POST['buy_now'] = False;
    }
}
if (isset($_POST['buy_now'])){
    if ($_POST['buy_now'] !== False) {
        if (isset($_POST['buy_now'])) {
            if (isset($logged_in_user)) {
                $name = $_POST['name'];
                $surname = $_POST['surname'];
                $email = $_POST['email'];
                $shipping_address = $_POST['address'];
                $country = $_POST['country'];
                $city = $_POST['city'];
                $province = $_POST['province'];
                $zip = $_POST['zip'];
                $payment_method = $_POST['paymentMethod'];
                $cc_name = $_POST['cc-name'];
                $cc_number = $_POST['cc-number'];
                $cc_expiration = $_POST['cc-expiration'];
                $cc_cvv = $_POST['cc-cvv'];

                if (empty($name) || empty($surname) || empty($email) || empty($shipping_address) || empty($country) || empty($city) || empty($province) || empty($zip) || empty($payment_method) || empty($cc_name) || empty($cc_number) || empty($cc_expiration) || empty($cc_cvv)) {
                    exit;
                }
                //crea un sale_order nel database
                $result = (object) $order_manager->create([
                    'user_id' => $logged_in_user->id,
                    'date_order' => $dateToday,
                    'shipping_address' => $shipping_address,
                    'country' => $country,
                    'province' => $province,
                    'city' => $city,
                    'zip' => $zip,
                ]);
                $order_id = $order_manager->get_last_order($logged_in_user->id);

                //crea linee di sale_order nel database
                $cart_items = $cart_manager->get_cart_items($cart_id);
                foreach ($cart_items as $cartitem) {
                    $result = $order_item_manager->create([
                        'order_id' => $order_id,
                        'product_id' => $cartitem['product_id'],
                        'quantity' => $cartitem['quantity'],
                    ]);

                };

                //svuota il carrello
                $cart_manager->delete_cart($cart_id);

                echo '<script>location.href="' . ROOT_URL . '/user?page=purchase_thank_you_page"</script>';
            } else {
                echo '<script>alert("Per procedere devi registrarti o fare login.");</script>;';
            }
        }
    }
}
?>
<div class="container">
    <main>
        <div class="py-5 text-center">
            <h2>Checkout</h2>
            <p class="lead">Completa l'acquisto compilando la scheda</p>
        </div>

        <div class="row g-5">
            <div class="col-md-5 col-lg-4 order-md-last">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-primary">Carrello</span>
                    <span class="badge bg-primary rounded-pill">
                        <?php echo count($cart_items) ?>
                    </span>
                </h4>
                <ul class="list-group mb-3">
                    <?php foreach ($cart_items as $cartitem) {
                        $product = $product_manager->get($cartitem['product_id']);
                        $total = $total + ($product->price * $cartitem['quantity']); ?>
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0">Prodotto</h6>
                                <small class="text-body-secondary">
                                    <?php echo $product->name ?>
                                </small>
                                <h6 class="my-2">Prezzo</h6>
                                <small class="text-body-secondary">
                                    <?php echo $product->price ?>
                                </small>
                                <h6 class="my-2">Quantità</h6>
                                <small class="text-body-secondary">
                                    <?php echo $cartitem['quantity'] ?>
                                </small>
                            </div>
                            <span class="text-body-secondary">€
                                <?php echo $product->price * $cartitem['quantity'] ?>
                            </span>
                        </li>
                    <?php } ?>
                </ul>

            </div>
            <div class="col-md-7 col-lg-8">
                <h4 class="mb-3">Indirizzo di spedizione</h4>
                <form class="needs-validation" method="POST">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label for="firstName" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Luca" value=""
                                required="">
                            <div class="invalid-feedback">
                                Inserisci un nome valido.
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label for="lastName" class="form-label">Cognome</label>
                            <input type="text" class="form-control" id="surname" name="surname" placeholder="D'Ambrosio" value=""
                                required="">
                            <div class="invalid-feedback">
                                Inserisci un cognome valido.
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com">
                            <div class="invalid-feedback">
                                Inserisci una email valida per essere aggiornato sulla spedizione.
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="address" class="form-label">Indirizzo</label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="Via Roma 12334"
                                required="">
                            <div class="invalid-feedback">
                                Inserisci un indirizzo di spedizione valido.
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="address2" class="form-label">Indirizzo 2 <span
                                    class="text-body-secondary">(Opzionale)</span></label>
                            <input type="text" class="form-control" id="address2" name="address2"
                                placeholder="Appartamento o piano terra">
                        </div>

                        <div class="col-md-4">
                            <label for="country" class="form-label">Nazione</label>
                            <select class="form-select" id="country" name="country" required="">
                            <?php $country_ids = $country_manager->getAll(); ?>
                                    <option value="">Scegli...</option>
                                <?php foreach($country_ids as $country_id){ ?>
                                    <option><?php echo $country_id->name ?></option>
                                <?php } ?>
                            </select>
                            <div class="invalid-feedback">
                                Seleziona una nazione valida.
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="state" class="form-label">Provincia</label>
                            <select class="form-select" id="province" name="province" required="">
                            <?php $province_ids = $province_manager->get_all_province_of_specific_country($country_id->id); ?>
                                <option value="">Scegli...</option>
                                <?php foreach($province_ids as $province_id){ ?>
                                    <option><?php echo $province_id->name ?></option>
                                <?php } ?>
                            </select>
                            <div class="invalid-feedback">
                                Seleziona una provincia valida.
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="state" class="form-label">Città</label>
                            <select class="form-select" id="city" name="city" required="">
                                <option value="">Scegli...</option>
                                <option>Pescara</option>
                            </select>
                            <div class="invalid-feedback">
                                Seleziona una città valida.
                            </div>
                        </div>

                        <div class="col-md-2">
                            <label for="zip" class="form-label">Cap</label>
                            <input type="text" class="form-control" id="zip" name="zip" placeholder="66023" required="">
                            <div class="invalid-feedback">
                                Inserisci un codice cap valido.
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="save-info" name="save_info">
                        <label class="form-check-label" for="save-info">Salva questo indirizzi per acquisti futuri</label>
                    </div>

                    <hr class="my-4">

                    <h4 class="mb-3">Pagamento</h4>

                    <div class="my-3">
                        <div class="form-check">
                            <input id="credit" name="paymentMethod" type="radio" class="form-check-input" checked=""
                                required="">
                            <label class="form-check-label" for="credit">Carta di credito/debito</label>
                        </div>
                    </div>

                    <div class="row gy-3">
                        <div class="col-md-6">
                            <label for="cc-name" class="form-label">Intestatario</label>
                            <input type="text" class="form-control" id="cc-name" name="cc-name" placeholder="Luca D'Ambrosio"
                                required="">
                            <small class="text-body-secondary">Nome completo mostrato sulla carta</small>
                            <div class="invalid-feedback">
                                L'intestatario è obbligatorio.
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="cc-number" class="form-label">Numero carta di credito/debito</label>
                            <input type="text" class="form-control" id="cc-number" name="cc-number" placeholder="1234 5678 9012 3456"
                                required="">
                            <div class="invalid-feedback">
                                Numero carta di credito obbligatorio.
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="cc-expiration" class="form-label">Scadenza</label>
                            <input type="text" class="form-control" id="cc-expiration" name="cc-expiration" placeholder="MM/AA" required="">
                            <div class="invalid-feedback">
                                Data di scadenza obbligatorio.
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="cc-cvv" class="form-label">CVV</label>
                            <input type="text" class="form-control" id="cc-cvv" name="cc-cvv" placeholder="*****" required="">
                            <div class="invalid-feedback">
                                Pin obbligatorio.
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <button class="w-100 btn btn-primary btn-lg mb-5" name="buy_now" type="submit">Acquista ora</button>
                </form>
            </div>
        </div>
    </main>
</div>