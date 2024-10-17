<form action="#" method="post">

    <!-- Patrimônio e Nome na mesma linha -->
    <div class="columns">
        <div class="column is-3">
            <div class="field">
                <label class="label">Patrimônio</label>
                <div class="control">
                    <input class="input" type="text" name="patrimonio" placeholder="Digite o patrimônio" required>
                </div>
            </div>
        </div>
        <div class="column is-9">
            <div class="field">
                <label class="label">Nome</label>
                <div class="control">
                    <input class="input" type="text" name="nome" placeholder="Digite o nome" required>
                </div>
            </div>
        </div>
    </div>

    <!-- Descrição ocupa a linha toda -->
    <div class="field">
        <label class="label">Descrição</label>
        <div class="control">
            <textarea class="textarea" name="descricao" placeholder="Digite uma descrição do item" required></textarea>
        </div>
    </div>

    <!-- Valor, Quantidade e Quantidade Mínima para Alerta na mesma linha -->
    <div class="columns">
        <div class="column is-4">
            <div class="field">
                <label class="label">Valor</label>
                <div class="control">
                    <input class="input" type="number" name="valor" placeholder="Digite o valor" step="0.01" required>
                </div>
            </div>
        </div>
        <div class="column is-4">
            <div class="field">
                <label class="label">Quantidade</label>
                <div class="control">
                    <input class="input" type="number" name="quantidade" placeholder="Digite a quantidade" required>
                </div>
            </div>
        </div>
        <div class="column is-4">
            <div class="field">
                <label class="label">Quantidade Mínima</label>
                <div class="control">
                    <input class="input" type="number" name="quantidade_minima" placeholder="Digite a quantidade mínima" required>
                </div>
                <p class="help">Defina uma quantidade de alerta, quando o item atingir essa quantidade, emitirá um alerta para reposição.</p>
            </div>
        </div>
    </div>

    <!-- Categoria ocupa a linha toda -->
    <div class="field">
        <label class="label">Categoria</label>
        <div class="control">
            <div class="select">
                <select name="categoria" required>
                    <option value="">Selecione uma categoria</option>
                    <option value="categoria1">Categoria 1</option>
                    <option value="categoria2">Categoria 2</option>
                    <option value="categoria3">Categoria 3</option>
                    <!-- Adicione mais opções conforme necessário -->
                </select>
            </div>
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