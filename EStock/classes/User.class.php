<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once 'crudUser.php';
class User extends Connection implements crudUser
{
    private $id, $nome, $email, $senha, $id_nivel;

    // Métodos Setters
    protected function setId($id)
    {
        $this->id = $id;
    }
    protected function setNome($nome)
    {
        $this->nome = $nome;
    }
    protected function setEmail($email)
    {
        $this->email = $email;
    }
    protected function setSenha($senha)
    {
        $this->senha = $senha;
    }
    protected function setId_nivel($id_nivel)
    {
        $this->id_nivel = $id_nivel;
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
    protected function getEmail()
    {
        return $this->email;
    }
    protected function getSenha()
    {
        return $this->senha;
    }
    protected function getId_nivel()
    {
        return $this->id_nivel;
    }

    //Métodos específicos
    public function dadosDoFormulario($nome, $email, $senha, $id_nivel)
    {
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = password_hash($senha, PASSWORD_DEFAULT); // Criptografando a senha
        $this->id_nivel = $id_nivel;
    }

    public function dadosDaTabela($id)
    {
        $conn = $this->connect();

        $this->setId($id);
        $_id = $this->getId();

        $sql = "SELECT * 
                FROM users
                WHERE id=:id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $_id);
        $stmt->execute();

        $result = $stmt->fetchAll();
        foreach ($result as $values):
            require_once '../forms/user/form-edit-user.php';
        endforeach;
    }

    //Métodos da interface
    public function create()
    {

        $conn = $this->connect();

        // Obtendo os valores dos atributos via getters
        $nome = $this->getNome();
        $email = $this->getEmail();
        $senha = $this->getSenha();

        //Query de inserção com placeholders nomeados
        $sql = "INSERT INTO users
        VALUES (DEFAULT, :nome, :email, :senha, DEFAULT)";

        //Preparando a query
        $stmt = $conn->prepare($sql);

        //Binding dos parâmetros
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha); // Assumido que a senha já está criptografada


        //Tentativa de execução da query
        if ($stmt->execute()):
            $_SESSION['sucesso'] = 'Cadastrado com sucesso';
            header("Location: ../../public/home.php"); // Redireciona para a home após o cadastro
        else:
            $_SESSION['erro'] = 'Usuário já cadastrado com este email';
            header("Location: ../../public/login.php"); // Redireciona para o login em caso de erro
        endif;
    }

    public function buscarPorEmail($email)
    {
        //Verificando se a conexão com o banco está ativa
        $conn = $this->connect();
        //Exibir o e-amil que está sendo passado para a consulta

        //Certificando que a consulta SQL está correta
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $conn->prepare($sql);

        //Certificando que o email está sendo vinculado corretamente
        $stmt->bindParam(':email', $email);

        // Executando a consulta e verificando se foi bem-sucedida
        $stmt->execute();

        // Recuperando o resultado da consulta
        $dados = $stmt->fetch(PDO::FETCH_ASSOC);

        return $dados;
    }

    public function login($email) {
        $conn = $this->connect();

        // Consulta SQL
        $sql = "SELECT u.id, u.nome, u.email, u.senha, n.nivel 
                FROM users u
                JOIN nivel n ON u.id_nivel = n.id_nivel
                WHERE u.email = :email";
        $stmt = $conn->prepare($sql);



        //Certificando que o email está sendo vinculado corretamente
        $stmt->bindParam(':email', $email);

        //Executando a consulta e verificando se foi bem sucedida
        $stmt->execute();

        //Recuperando o resultado da consulta
        $dados = $stmt->fetch(PDO::FETCH_ASSOC);

        return $dados;
    }

    public function buscarPorId($id)
    {
        $conn = $this->connect();

        $sql = "SELECT * 
                FROM user 
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

        $sql = "SELECT users.id, users.nome, users.email, nivel.nivel
        FROM users
        JOIN nivel ON users.id_nivel = nivel.id_nivel
        WHERE users.nome LIKE :search
        ORDER BY users.nome";


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
        echo '<th class="is-narrow">Email</th>';
        echo '<th class="is-narrow">Nível</th>';
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
            echo '<td>' . $values['email'] . '</td>';
            echo '<td>' . $values['nivel'] . '</td>';
            echo "<td>
                    <a href='edit_user.php?id=$id'><span class='icon is-small'><i class='fas fa-square-pen' style='color: #74C0FC'></i></span></a>
                    <span style='color: #515151; height: 100%; margin: 2px;'>|</span>
                    <a href='..database/user/delete.php?id=$id'><span class='icon is-small'><i class='fas fa-square-minus' style='color: #bd0000'></i></span></a>
                  </td>";
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
    }
    
    public function update($nome, $email, $senha, $id, $paginaOrigem) {
        $conn = $this->connect();
    
        // Se a senha estiver vazia, mantém a senha atual
        if (empty($senha)) {
            // Obtém a senha atual do usuário
            $sql = "SELECT senha FROM users WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $senha = $stmt->fetchColumn(); // Mantém a senha atual
        } else {
            // Hash a nova senha
            $senha = password_hash($senha, PASSWORD_DEFAULT);
        }
    
        // Atualiza os dados do usuário no banco de dados
        $sql = "UPDATE users SET nome = :nome, email = :email, senha = :senha WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);
        $stmt->bindParam(':id', $id);
    
        if ($stmt->execute()) {
            // Redireciona para a página de origem com uma mensagem de sucesso
            $_SESSION['success_message'] = "Dados atualizados com sucesso!";
            header("Location: ../../public/management.php");
            exit;
        } else {
            // Caso haja falha, define uma mensagem de erro e redireciona
            $_SESSION['error_message'] = "Erro ao atualizar os dados.";
            header("Location: ../../public/management.php");
            exit;
        }
    }
    

    public function delete($id)
    {
        $conn = $this->connect();

        $this->setId($id);
        $_id = $this->getId();

        $sql = "DELETE
                FROM users 
                WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        header("Location: ../../public/management.php");

    }
}
