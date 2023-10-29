<?php 
$include_sidebar = false;
if (isset($_POST['send_email'])){
    echo '<script>location.href="'.ROOT_URL.'?page=contact_thank_you_page"</script>';
    exit; 
}
?>

<div class="container">
    <main>
        <div class="py-5 text-center">
        <img class="d-block mx-auto mb-4" src="../front-end\assets\imgs\icons8lampada96.png" alt="" width="72" height="57">
        <h2>Mettiti in contatto</h2>
        </div>

        <div class="row g-5">
        <div class="col-md-12 col-lg-12">
            <h4 class="mb-3">Invia E-mail</h4>
            <form class="needs-validation" method="POST">
                <div class="row g-3">
                    
                    <div class="col-12">
                        <label for="name" class="form-label">Nome</label>
                        <input type="name" class="form-control" id="name" name="name" placeholder="Luca" required="">
                    </div>

                    <div class="col-12">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" required="">
                        <div class="invalid-feedback">
                            Please enter a valid email address for shipping updates.
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="message" class="form-label">Messaggio</label>
                        <input type="text" class="form-control" id="message" name="message" placeholder="Vorrei avere informazioni riguardo ..." required="">
                        <div class="invalid-feedback">
                            Please enter your shipping address.
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <button class="w-100 btn btn-primary btn-lg mb-5" name="send_email" type="submit">Invia</button>
            </form>
        </div>
        </div>
    </main>
</div>

