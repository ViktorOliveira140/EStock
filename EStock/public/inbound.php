<?php
    require_once("../config/header.php");
    require_once("../config/navbar.php");
    ?>
    <section class="section is-medium" id="conteudo">
        <div class="container" id="conteudo">
            <div class="notification has-background-white">
                <?php
                require_once '../classes/autoload.php';

                $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

                $editItem = new Item();
                $editItem->dadosDaTabela($id, 'adicionar');

                ?>
            </div>
        </div>
    </section>

    <?php
    require_once("../config/footer.php");
    ?>