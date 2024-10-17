<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once 'crudItem.php';
class Item extends Connection implements crudItem
{
    private $id, $nome, $descricao, $codigo_patrimonio, $valor, $quantidade, $quantidade_minima, $categoria_id;

    // Métodos Setters
    protected function setId($id)
    {
        $this->id = $id;
    }
    protected function setNome($nome)
    {
        $this->nome = $nome;
    }
    protected function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }
    protected function setCodigo_patrimonio($codigo_patrimonio)
    {
        $this->codigo_patrimonio = $codigo_patrimonio;
    }
    protected function setValor($valor)
    {
        $this->valor = $valor;
    }
    protected function setQuantidade($quantidade)
    {
        $this->quantidade = $quantidade;
    }
    protected function setQuantidade_minima($quantidade_minima)
    {
        $this->quantidade_minima = $quantidade_minima;
    }
    protected function setCategoria_id($categoria_id)
    {
        $this->categoria_id = $categoria_id;
    }


    //Métodos Getters
    protected function getId()
    {
        return $this->id;
    }
    protected function getNome()
    {
        return $this->nome;
    }
    protected function getDescricao()
    {
        return $this->descricao;
    }
    protected function getCodigo_patrimonio()
    {
        return $this->codigo_patrimonio;
    }
    protected function getValor()
    {
        return $this->valor;
    }
    protected function getQuantidade()
    {
        return $this->quantidade;
    }
    protected function getQuantidade_minima()
    {
        return $this->quantidade_minima;
    }
    protected function getCategoria_id()
    {
        return $this->categoria_id;
    }


    //Métodos específicos
    public function dadosDoFormulario($nome, $descricao, $codigo_patrimonio, $valor, $quantidade, $quantidade_minima, $categoria_id)
    {
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->codigo_patrimonio = $codigo_patrimonio;
        $this->valor = $valor;
        $this->quantidade = $quantidade;
        $this->quantidade_minima = $quantidade_minima;
        $this->categoria_id = $categoria_id;
    }

    public function retirarQuantidade($id, $quantidade_retirada)
    {
        $conn = $this->connect();  // Conectando ao banco de dados
        $sql = "UPDATE item SET quantidade = quantidade - :quantidade_retirada WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':quantidade_retirada', $quantidade_retirada, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function adicionarQuantidade($id, $quantidade_adicionada)
    {
        $conn = $this->connect();  // Conectando ao banco de dados
        $sql = "UPDATE item SET quantidade = quantidade + :quantidade_adicionada WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':quantidade_adicionada', $quantidade_adicionada, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }




    public function dadosDaTabela($id, $acao)
    {
        $conn = $this->connect();

        $this->setId($id);
        $_id = $this->getId();

        $sql = "SELECT item.*, categoria.nome AS categoria_nome 
        FROM item
        JOIN categoria ON item.categoria_id = categoria.id
        WHERE item.id = :id";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $_id);
        $stmt->execute();

        $result = $stmt->fetchAll();
        foreach ($result as $values):
            // Verifique o valor da ação e inclua o formulário correto
            if ($acao === 'adicionar') {
                require_once __DIR__ . '/../forms/item/form_item_inbound.php'; // Formulário para adicionar itens
            } elseif ($acao === 'retirar') {
                require_once __DIR__ . '/../forms/item/form_item_outbound.php'; // Formulário para retirar itens
            }
        endforeach;
    }

    public function dashEstoque() {
        $conn = $this->connect();
        $sql = "SELECT item.id, item.nome, item.descricao, item.codigo_patrimonio, item.valor, item.quantidade, item.quantidade_minima, categoria.nome AS categoria_nome
        FROM item
        JOIN categoria ON item.categoria_id = categoria.id
        ORDER BY item.nome";

        $stmt = $conn->prepare($sql);
        $stmt->execute();
    
        $data = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data; // Retorna os dados para serem usados no JSON
    }
    


    //Métodos da interface
    public function create()
    {

        $conn = $this->connect();

        // Obtendo os valores dos atributos via getters
        $nome = $this->getNome();
        $descricao = $this->getDescricao();
        $codigo_patrimonio = $this->getCodigo_patrimonio();
        $valor = $this->getValor();
        $quantidade = $this->getQuantidade();
        $quantidade_minima = $this->getQuantidade_minima();
        $categoria_id = $this->getCategoria_id();

        //Query de inserção com placeholders nomeados
        $sql = "INSERT INTO item
        VALUES (DEFAULT, :nome, :descricao, :codigo_patrimonio, :valor, :quantidade, :quantidade_minima, :categoria_id)";

        //Preparando a query
        $stmt = $conn->prepare($sql);

        //Binding dos parâmetros
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':codigo_patrimonio', $codigo_patrimonio);
        $stmt->bindParam(':valor', $valor);
        $stmt->bindParam(':quantidade', $quantidade);
        $stmt->bindParam(':quantidade_minima', $quantidade_minima);
        $stmt->bindParam(':categoria_id', $categoria_id);


        //Tentativa de execução da query
        if ($stmt->execute()):
            $_SESSION['sucesso'] = 'Item cadastrado com sucesso!';
            header("Location: ../../public/home.php"); // Redireciona para a home após o cadastro
        else:
            $_SESSION['erro'] = 'Item já cadastrado.';
            header("Location: ../../public/home.php");
        endif;
    }

    public function buscarPorPatrimonio($codigo_patrimonio)
    {
        //Verificando se a conexão com o banco está ativa
        $conn = $this->connect();
        //Exibir o e-amil que está sendo passado para a consulta

        //Certificando que a consulta SQL está correta
        $sql = "SELECT * FROM item WHERE codigo_patrimonio = :codigo_patrimonio";
        $stmt = $conn->prepare($sql);

        //Certificando que o email está sendo vinculado corretamente
        $stmt->bindParam(':codigo_patrimonio', $codigo_patrimonio);

        // Executando a consulta e verificando se foi bem-sucedida
        $stmt->execute();

        // Recuperando o resultado da consulta
        $dados = $stmt->fetch(PDO::FETCH_ASSOC);

        return $dados;
    }


    public function buscarPorId($id)
    {
        $conn = $this->connect();

        $sql = "SELECT * 
                FROM item 
                WHERE id = :id";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $dados = $stmt->fetch(PDO::FETCH_ASSOC);

        return $dados;
    }

    public function read($search)
    {
        $conn = $this->connect();
        $search = $search . "%";

        $sql = "SELECT item.id, item.nome, item.descricao, item.codigo_patrimonio, item.valor, item.quantidade, categoria.nome AS categoria_nome
                FROM item
                JOIN categoria ON item.categoria_id = categoria.id
                WHERE item.codigo_patrimonio LIKE :search
                ORDER BY item.nome";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':search', $search);
        $stmt->execute();

        $result = $stmt->fetchAll();

        // Início da tabela
        echo '<table class="table is-striped is-hoverable is-fullwidth">';
        echo '<thead>';
        echo '<tr>';
        echo '<th class="is-narrow">ID</th>';
        echo '<th class="is-narrow">Nome</th>';
        echo '<th class="is-narrow">Descrição</th>';
        echo '<th class="is-narrow">Patrimônio</th>';
        echo '<th class="is-narrow">Valor</th>';
        echo '<th class="is-narrow">Qtd.</th>';
        echo '<th class="is-narrow">Categoria</th>';
        echo '<th class="is-narrow">Ações</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        // Loop para exibir os itens
        foreach ($result as $values) {
            $this->setId($values['id']);
            $id = $this->getId();

            echo '<tr>';
            echo '<td>' . $values['id'] . '</td>';
            echo '<td>' . $values['nome'] . '</td>';
            echo '<td>' . $values['descricao'] . '</td>';
            echo '<td>' . $values['codigo_patrimonio'] . '</td>';
            echo '<td>R$ ' . number_format($values['valor'], 2, ',', '.') . '</td>';
            echo '<td>' . $values['quantidade'] . '</td>';
            echo '<td>' . $values['categoria_nome'] . '</td>';
            echo "<td>
                    <a href='inbound.php?id=$id'><span class='icon is-small'><i class='fas fa-square-plus' style='color: #74C0FC'></i></span></a>
                    <span style='color: #515151; height: 100%; margin: 2px;'>|</span>
                    <a href='outbound.php?id=$id'><span class='icon is-small'><i class='fas fa-square-minus' style='color: #bd0000'></i></span></a>
                  </td>";
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
    }

    public function update($nome, $descricao, $codigo_patrimonio, $valor, $quantidade, $quantidade_minima, $categoria_id, $id, $paginaOrigem)
    {
        $conn = $this->connect();

        // Definindo os valores usando setters
        $this->setNome($nome);
        $this->setDescricao($descricao);
        $this->setCodigo_patrimonio($codigo_patrimonio);
        $this->setValor($valor);
        $this->setQuantidade($quantidade);
        $this->setQuantidade_minima($quantidade_minima);
        $this->setCategoria_id($categoria_id);
        $this->setId($id);

        // Obtendo os valores usando getters
        $_nome = $this->getNome();
        $_descricao = $this->getDescricao();
        $_codigo_patrimonio = $this->getCodigo_patrimonio();
        $_valor = $this->getValor();
        $_quantidade = $this->getQuantidade();
        $_quantidade_minima = $this->getQuantidade_minima();
        $_categoria_id = $this->getCategoria_id();
        $_id = $this->getId();

        // Preparando a consulta de atualização
        $sql = "UPDATE item
            SET nome = :nome, descricao = :descricao, codigo_patrimonio = :codigo_patrimonio, 
                valor = :valor, quantidade = :quantidade, quantidade_minima = :quantidade_minima, 
                categoria_id = :categoria_id
            WHERE id = :id";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nome', $_nome);
        $stmt->bindParam(':descricao', $_descricao);
        $stmt->bindParam(':codigo_patrimonio', $_codigo_patrimonio);
        $stmt->bindParam(':valor', $_valor);
        $stmt->bindParam(':quantidade', $_quantidade);
        $stmt->bindParam(':quantidade_minima', $_quantidade_minima);
        $stmt->bindParam(':categoria_id', $_categoria_id);
        $stmt->bindParam(':id', $_id);

        // Executando a atualização
        $stmt->execute();

        // Lógica de redirecionamento baseada na página de origem
        if ($paginaOrigem == 'edit-item.php') {
            $destino = '../../public/item.php'; // Exemplo: redirecionar para a página de administração de itens
        } elseif ($paginaOrigem == 'detalhes-item.php') {
            $destino = '../../public/detalhes-item.php'; // Exemplo: redirecionar para a página de detalhes do item
        } else {
            $destino = 'home.php'; // Redirecionamento padrão
        }

        // Redireciona para a página de destino
        header("Location: $destino");
        exit();
    }

    public function delete($id)
    {
        $conn = $this->connect();

        $this->setId($id);
        $_id = $this->getId();

        $sql = "DELETE
                FROM item 
                WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        header("Location: ../../public/stock.php");
    }
}
