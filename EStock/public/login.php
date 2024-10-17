<?php
require_once("../config/header_login.php");
?>

<section class="section">
    <div class="container">
        <div class="columns is-centered">
            <div class="column is-4">
                <div id="login-form" class="box">
                    <h2 class="title is-4 has-text-centered">Login</h2>
                    <form action="<?= $BASE_URL ?>database/user/login.php" method="POST">
                        <?php
                        if (isset($_SESSION['erro'])) {
                            echo "<div class='notification is-danger'>" . $_SESSION['erro'] . "</div>";
                            unset($_SESSION['erro']); // Remove a mensagem de erro após exibi-la
                        }
                        ?>

                        <input type="hidden" name="type" value="login">
                        <div class="field">
                            <label for="email" class="label">Email</label>
                            <div class="control">
                                <input type="email" id="email" name="email" class="input" placeholder="Digite seu email" required>
                            </div>
                        </div>
                        <div class="field">
                            <label for="senha" class="label">Senha</label>
                            <div class="control">
                                <input type="password" class="input" name="senha" id="senha" placeholder="Digite sua senha" required>
                            </div>
                        </div>
                        <div class="field">
                            <button id="btn-base" type="submit" class="button is-fullwidth">Entrar</button>
                        </div>
                        <div class="field has-text-centered">
                            <button id="btn-sbase" type="button" class="button is-small" onclick="toggleForms()">Registrar-se</button>
                        </div>
                    </form>
                </div>


                <div id="register-form" class="box is-hidden">
                    <h2 class="title is-4 has-text-centered">Registrar-se</h2>
                    <form action="<?= $BASE_URL ?>database/user/create.php" method="POST">
                        <input type="hidden" name="type" value="register">
                        <div class="field">
                            <label for="nome" class="label">Nome</label>
                            <div class="control">
                                <input type="text" class="input" id="nome" name="nome" placeholder="Digite seu nome" required>
                            </div>
                        </div>
                        <div class="field">
                            <label for="email" class="label">E-mail</label>
                            <div class="control">
                                <input type="email" class="input" id="email" name="email" placeholder="Digite seu e-mail" required>
                            </div>
                        </div>
                        <div class="field">
                            <label for="password" class="label">Senha</label>
                            <div class="control">
                                <input type="password" class="input" id="senha" name="senha" placeholder="Digite sua senha" required>
                            </div>
                        </div>
                        <div class="field">
                            <label for="confirmpassword" class="label">Confirmação de senha</label>
                            <div class="control">
                                <input type="password" class="input" id="confirmpassword" name="confirmpassword" placeholder="Confirme sua senha" required>
                            </div>
                        </div>
                        <div class="field">
                            <button id="btn-base" type="submit" class="button is-fullwidth">Registrar</button>
                        </div>
                        <div class="field has-text-centered">
                            <button id="btn-sbase" type="button" class="button is-small" onclick="toggleForms()">Logar-se</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</section>


<?php
require_once("../config/footer.php");
?>