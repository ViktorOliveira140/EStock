<?php
require_once("../config/header.php");
require_once("../config/navbar.php");
?>
<section class="section is-medium" id="conteudo">
    <div class="container" id="conteudo">
        <div class="notification has-background-white">
            <div class="row">
                <div class="col">
                    <b>Registro de Item</h1>
                        <hr>
                        <div class="container is-fluid">
                            <div class="notification has-background-white-ter">
                                <?php require_once '../forms/category/form_category_create.php'; ?>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php
require_once("../config/footer.php");
?>