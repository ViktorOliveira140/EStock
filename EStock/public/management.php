<?php
require_once("../config/header.php");
require_once("../config/navbar.php");
?>


<section class="section is-medium" id="conteudo">
  <div class="container" id="conteudo">
    <div id="stock" class="notification has-background-white">
      <div class="row">
        <div class="col">
          <b>Controle de usuários</h1>
            <hr>
            <!-- Barra de Pesquisa -->
            <div class="container is-fluid">
              <div class="notification has-background-white-ter">
                <?php require_once '../forms/user/form_consulta.php'; ?><br>
                  <?php
                  require_once '../database/user/read.php';
                  ?>
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