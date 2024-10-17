<?php session_start() ?>
<div class="container" id="conteudo">
  <div class="notification has-background-white">
    <h2>Olá <?php echo $_SESSION['nome']; ?></h2>
    <p>Através deste sistema, você poderá gerenciar o estoque da empresa Estock.</p>
    <p>Para isso, deverá possuir a devida credencial para cada função deste sistema.</p>
    <br>
    <p>Sua credencial é de: <b><?php echo $_SESSION['nivel']; ?></b>. Para mais informações, consulte o administrador.</p>
</div>
  </div>
</div>