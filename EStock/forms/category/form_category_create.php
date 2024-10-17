<form action="../database/category/create.php" method="post" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?php echo $id ?>">
    <!-- Patrimônio e Nome na mesma linha -->
    <div class="columns">
        <div class="column is-">
            <div class="field">
                <label class="label">Nome</label>
                <div class="control">
                    <input class="input" type="text" name="nome" id="nome" placeholder="Digite o nome" required>
                </div>
            </div>
        </div>
    </div>

    <!-- Descrição ocupa a linha toda -->
    <div class="field">
        <label class="label">Descrição</label>
        <div class="control">
            <textarea class="textarea" name="descricao" id="descricao" placeholder="Digite uma descrição do item" required></textarea>
        </div>
    </div>

    <!-- Botão de Enviar -->
    <div class="field is-grouped">
        <div class="control">
            <button type="submit" class="button is-primary">Enviar</button>
        </div>
        <div class="control">
            <button type="reset" class="button is-light">Limpar</button>
        </div>
    </div>
</form>