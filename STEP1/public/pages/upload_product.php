<?php
$include_sidebar = false;
$supplier_manager = new SupplierManager();
$category_manager = new CategoryManager();
$product_type_manager = new ProductTypeManager();
$supplier_ids = $supplier_manager->getAll();
$category_ids = $category_manager->getAll();
$product_type_ids = $product_type_manager->getAll();
if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $price = $_POST["price"];
    $description = $_POST["description"];
    $supplier = $_POST["supplier"];
    $category = $_POST["category"];
    $product_type = $_POST["product_type"];
    if ($_FILES["image"]["error"] === 4) {
        echo
            "<script> alert('Immagine non esiste');</script>";
    } else {
        $file_name = $_FILES["image"]["name"];
        $file_size = $_FILES["image"]["size"];
        $tmp_name = $_FILES["image"]["tmp_name"];

        $valid_image_extension = [".png"];
        $image_extension = explode(".", $file_name);
        $image_extension = strtolower(end($image_extension));
        if ($file_size > 10000000) {
            echo "
            <script>alert('Immagine troppo grande')</script>";
        } else {
            $new_image_name = uniqid();
            $new_image_name .= '.' . $image_extension;
            move_uploaded_file($tmp_name, ROOT_PATH . 'STEP2/db_images/' . $new_image_name);
            echo ROOT_PATH . 'STEP2/db_images/' . $new_image_name;
            $product_manager = new ProductManager();
            $new_product = $product_manager->create([
                'name' => $name,
                'price' => $price,
                'description' => $description,
                'supplier_id' => $supplier,
                'category_id' => $category,
                'product_type_id' => $product_type,
                'image' => $new_image_name,
            ]);
            echo
                "<script> alert('Aggiunto con successo');</script>";
        }
    }
    echo '<script>location.href="'.ROOT_URL.'?page='.$page.'"</script>';
    exit;
}
?>
<form method="post">
    <div class="row g-5">
        <div class="col-12">
            <h4 class="mb-3">Aggiungi Prodotto</h4>
            <form class="needs-validation" novalidate="">
                <div class="row g-3">
                    <div class="col-sm-6">
                        <label for="name" class="form-label">Nome Prodotto</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Lampada ..." required="">
                    </div>

                    <div class="col-sm-6">
                        <label for="price" class="form-label">Prezzo</label>
                        <input type="text" class="form-control" id="price" name="price" placeholder="" required="">
                    </div>

                    <div class="col-sm-12">
                        <label for="description" class="form-label">Descrizione</label>
                        <input type="text" class="form-control" id="description" name="description" placeholder="" required="">
                    </div>

                    <div class="col-md-4">
                        <label for="supplier" class="form-label">Fornitore</label>
                        <select class="form-select" id="supplier" name="supplier" required="">
                            <option value="">Scegli...</option>
                            <?php foreach($supplier_ids as $supplier_id){ ?>
                                <option value="<?php echo $supplier_id->id ?>"><?php echo $supplier_id->name ?></option>
                            <?php }?>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="category" class="form-label">Categoria</label>
                        <select class="form-select" id="category" name="category" required="">
                            <option value="">Scegli...</option>
                            <?php foreach($category_ids as $category_id){ ?>
                                <option value="<?php echo $category_id->id ?>"><?php echo $category_id->name ?></option>
                            <?php }?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="product_type" class="form-label">Tipo Prodotto</label>
                        <select class="form-select" id="product_type" name="product_type" required="">
                            <option value="">Scegli...</option>
                            <?php foreach($product_type_ids as $product_type_id){ ?>
                                <option value="<?php echo $product_type_id->id ?>"><?php echo $product_type_id->name ?></option>
                            <?php }?>
                        </select>
                    </div>
                    <hr class="my-4">
                    <div class="col-md-12">
                        <label for="name" class="form-label">Immagine</label>
                        <input type="file" class="form-control" name="image" id="image" accept=".png" value="" required=""><br><br>
                    </div>
                </div>

                <button class="w-100 btn btn-primary btn-lg mb-5" type="submit" name="submit">Aggiungi Prodotto</button>
            </form>
        </div>
    </div>
    </div>
</form>

<a href="<?php echo ROOT_URL; ?>?page=data">Data</a>