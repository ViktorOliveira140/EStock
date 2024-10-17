<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once 'crudCategory.php';
class Category extends Connection implements crudCategory
{
    private $id, $nome, $descricao;

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


    //Métodos específicos
    public function dadosDoFormulario($nome, $descricao)
    {
        $this->nome = $nome;
        $this->descricao = $descricao;
    }

    public function dadosDaTabela($id)
    {
        $conn = $this->connect();

        $this->setId($id);
        $_id = $this->getId();

        $sql = "SELECT * 
                FROM categoria
                WHERE id=:id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $_id);
        $stmt->execute();

        $result = $stmt->fetchAll();
        foreach ($result as $values):
            require_once '../forms/form-edit-categoria.php';
        endforeach;
    }

    //Métodos da interface
    public function create()
    {

        $conn = $this->connect();

        // Obtendo os valores dos atributos via getters
        $nome = $this->getNome();
        $descricao = $this->getDescricao();

        //Query de inserção com placeholders nomeados
        $sql = "INSERT INTO categoria
        VALUES (DEFAULT, :nome, :descricao)";

        //Preparando a query
        $stmt = $conn->prepare($sql);

        //Binding dos parâmetros
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':descricao', $descricao);


        //Tentativa de execução da query
        if ($stmt->execute()):
            $_SESSION['sucesso'] = 'Categoria cadastrada com sucesso!';
            header("Location: ../../public/home.php"); // Redireciona para a home após o cadastro
        else:
            $_SESSION['erro'] = 'Categoria já cadastrada.';
            header("Location: ../../public/home.php");
        endif;
    }

    public function buscarPorNome($nome)
    {
        //Verificando se a conexão com o banco está ativa
        $conn = $this->connect();
        //Exibir o e-amil que está sendo passado para a consulta

        //Certificando que a consulta SQL está correta
        $sql = "SELECT * FROM categoria WHERE nome = :nome";
        $stmt = $conn->prepare($sql);

        //Certificando que o email está sendo vinculado corretamente
        $stmt->bindParam(':nome', $nome);

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
                FROM categoria 
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
    
        $sql = "SELECT *
                FROM categoria
                WHERE nome LIKE :search
                ORDER BY nome";
    
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
            echo "<td>
                    <a href='edit-categoria.php?id=$id'><span class='icon is-small'><i class='fas fa-pen' style='color: #63E6BE'></i></span></a>
                    <span style='color: #ccc; margin: 4px;'>|</span>
                    <a href='../database/category/delete.php?id=$id'><span class='icon is-small'><i class='fas fa-trash' style='color: #ff0000'></i></span></a>
                  </td>";
            echo '</tr>';
        }
    
        echo '</tbody>';
        echo '</table>';
    }
    
    public function update($nome, $descricao, $id, $paginaOrigem)
    {
        $conn = $this->connect();

        // Definindo os valores usando setters
        $this->setNome($nome);
        $this->setDescricao($descricao);
        $this->setId($id);

        // Obtendo os valores usando getters
        $_nome = $this->getNome();
        $_descricao = $this->getDescricao();
        $_id = $this->getId();

        // Preparando a consulta de atualização
        $sql = "UPDATE categoria
            SET nome = :nome, descricao = :descricao
            WHERE id = :id";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nome', $_nome);
        $stmt->bindParam(':descricao', $_descricao);
        $stmt->bindParam(':id', $_id);

        // Executando a atualização
        $stmt->execute();

        // Lógica de redirecionamento baseada na página de origem
        if ($paginaOrigem == 'edit-category.php') {
            $destino = '../../public/category.php'; // Exemplo: redirecionar para a página de administração de itens
        } elseif ($paginaOrigem == 'detalhes-category.php') {
            $destino = '../../public/detalhes-category.php'; // Exemplo: redirecionar para a página de detalhes do item
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
                FROM categoria 
                WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        header("Location: ../../public/category.php");
    }
}
