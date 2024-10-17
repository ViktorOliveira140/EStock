<?php
require_once("../config/header.php");
require_once("../config/navbar.php");
?>


<section class="section is-medium" id="conteudo">
  <div class="container" id="conteudo">
    <div id="stock" class="notification has-background-white">
      <div class="row">
        <div class="col">
          <b>Lista Estoque</h1>
            <hr>
            <!-- Barra de Pesquisa -->
            <div class="container is-fluid">
              <div class="notification has-background-white-ter">
                <?php require_once '../forms/item/form_consulta.php'; ?><br>
                <table class="">
                  <?php
                  require_once '../database/item/read.php';
                  ?>
                </table>
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