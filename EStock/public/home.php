<?php
require_once("../config/sessao.php");
require_once("../config/header.php");
require_once("../config/navbar.php");
?>




<section class="section is-medium" id="conteudo">
    <div class="container" id="conteudo">
        <div id="stock" class="notification has-background-white">
            <div class="row">
                <div class="col">
                    <!-- Barra de Pesquisa -->
                    <div class="container is-fluid">
                        <div class="notification has-background-white-ter">
                            <h2>Olá <?php echo $_SESSION['nome']; ?></h2>
                            <p>Através deste sistema, você poderá gerenciar o estoque da empresa Estock.</p>
                            <p>Para isso, deverá possuir a devida credencial para cada função deste sistema.</p>
                            <br>
                            <p>Sua credencial é de: <b><?php echo $_SESSION['nivel']; ?></b>. Para mais informações, consulte o administrador.</p>
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