<form action="../database/item/inbound.php" method="post">
<input type="hidden" name="id" value="<?php echo $id ?>">
    <!-- Patrimônio e Nome na mesma linha -->
    <div class="columns">
        <div class="column is-3">
            <div class="field">
                <label class="label">Patrimônio</label>
                <div class="control">
                    <input class="input" type="text" name="patrimonio" value="<?php echo $values['codigo_patrimonio'] ?>" disabled>
                </div>
            </div>
        </div>
        <div class="column is-9">
            <div class="field">
                <label class="label">Nome</label>
                <div class="control">
                    <input class="input" type="text" name="nome" value="<?php echo $values['nome'] ?>" disabled>
                </div>
            </div>
        </div>
    </div>

    <!-- Valor, Quantidade, Descrição e Categoria na mesma linha -->
    <div class="columns">
        <div class="column is-7">
            <div class="field">
                <label class="label">Descrição</label>
                <div class="control">
                    <input class="input" type="text" name="descricao" value="<?php echo $values['descricao'] ?>" disabled>
                </div>
            </div>
        </div>
        <div class="column is-2">
            <div class="field">
                <label class="label">Valor</label>
                <div class="control">
                    <input class="input" type="number" name="valor" step="0.01" value="<?php echo $values['valor'] ?>" disabled>
                </div>
            </div>
        </div>
        <div class="column is-1">
            <div class="field">
                <label class="label">Quantidade</label>
                <div class="control">
                    <input class="input" type="number" name="quantidade" value="<?php echo $values['quantidade'] ?>" disabled>
                </div>
            </div>
        </div>
        <div class="column is-2">
            <div class="field">
                <label class="label">Categoria</label>
                <div class="control">
                    <input class="input" type="text" name="categoria" value="<?php echo $values['categoria_nome'] ?>" disabled>
                </div>
            </div>
        </div>
    </div>

    <!-- Quantidade a Retirar -->
    <div class="field">
        <label class="label">Quantidade adicionada</label>
        <div class="control">
            <input class="input" type="number" name="quantidade_adicionada" placeholder="Informe a quantidade adicionada" required>
        </div>
    </div>

    <!-- Botões de Enviar e Voltar -->
    <div class="field is-grouped">
        <div class="control">
            <button type="submit" class="button is-primary">Retirar</button>
        </div>
        <div class="control">
            <a href="javascript:history.back()" class="button is-light">Voltar</a>
        </div>
    </div>

</form>