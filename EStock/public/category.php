<?php
require_once("../config/header.php");
require_once("../config/navbar.php");
?>
<section class="section is-medium" id="conteudo">
  <div class="container" id="conteudo">
    <div class="notification has-background-white">
      <div class="row">
        <div class="col">
          <b>Lista Categorias</h1>
            <hr>
            <div class="table-container">
              <table class="striped">
                <?php
                require_once '../database/category/read.php';
                ?>
              </table>
            </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
require_once("../config/footer.php");
?>