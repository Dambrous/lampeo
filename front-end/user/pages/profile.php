<?php
$include_sidebar = false;
if (isset($_SESSION['user'])) {
    $user = (object) $_SESSION['user'];
} else{
    session_start();
    $user = (object) $_SESSION['user'];
}
?>
<section class="vh-100">
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-lg-6 mb-4 mb-lg-0">
                <div class="card mb-3" style="border-radius: .5rem;">
                    <div class="row g-0">
                        <div class="col-md-4 gradient-custom text-center text-black"
                            style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                            <img src="../../back-end\db_images\avatar_example.png"
                            alt="Avatar" class="img-fluid my-5" style="width: 80px;" />
                        </div>
                        <div class="col-md-8">
                            <div class="card-body p-4">
                                <h6>Informazioni</h6>
                                <hr class="mt-0 mb-4">
                                <div class="row pt-1">
                                    <div class="col-12 mb-3">
                                    <h6>Email</h6>
                                    <p class="text-muted"><?php echo $user->email?></p>
                                    </div>
                                </div>
                                <div class="row pt-1">
                                    <div class="col-6 mb-3">
                                    <h6>Nome</h6>
                                    <p class="text-muted"><?php echo $user->name?></p>
                                    </div>
                                    <div class="col-6 mb-3">
                                    <h6>Cognome</h6>
                                    <p class="text-muted"><?php echo $user->surname?></p>
                                    </div>
                                </div>
                                <div class="row pt-1">
                                    <div class="col-12 mb-3">
                                    <h6>Data Creazione</h6>
                                    <p class="text-muted"><?php echo $user->created_at?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>