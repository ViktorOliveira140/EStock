<form action="../database/user/update.php" method="post">
    <input type="hidden" name="id" value="<?php echo $id ?>">
    <div class="columns">
        <div class="column is-3">
            <div class="field">
                <label class="label">Nome</label>
                <div class="control">
                    <input class="input" type="text" name="nome" value="<?php echo $values['nome'] ?>" disabled>
                </div>
            </div>
        </div>
        <div class="column is-6">
            <div class="field">
                <label class="label">Email</label>
                <div class="control">
                    <input class="input" type="email" name="email" value="<?php echo $values['email'] ?>" disabled>
                </div>
            </div>
        </div>
        <div class="column is-3">
            <div class="field">
                <label class="label">Senha</label>
                <div class="control">
                    <input class="input" type="password" name="senha" value="" disabled>
                </div>
            </div>
        </div>
    </div>

    <!-- Botões de Salvar e Voltar -->
    <div class="field is-grouped">
        <div class="control">
            <button id="saveButton" class="button is-primary is-hidden" type="submit">Salvar</button>
            <button id="editButton" class="button is-info" type="button" onclick="enableEdit()"><i class="fa-solid fa-square-pen"></i></button>
        </div>
        <div class="control">
            <a href="javascript:history.back()" class="button is-light">Voltar</a>
        </div>
    </div>
</form>

<script>
    function enableEdit() {
        // Habilitar todos os inputs
        const inputs = document.querySelectorAll('input[type="text"], input[type="email"], input[type="password"]');
        inputs.forEach(input => input.removeAttribute('disabled'));

        // Alternar visibilidade dos botões
        document.getElementById('editButton').classList.add('is-hidden'); // Esconder o botão de Editar
        document.getElementById('saveButton').classList.remove('is-hidden'); // Mostrar o botão de Salvar
    }
</script>