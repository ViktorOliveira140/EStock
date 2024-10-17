<?php
session_start();
require_once '../../classes/autoload.php';

$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);

if ($email && $senha) {
    $user = new User();
    $dadosUsuario = $user->login($email);

    if ($dadosUsuario) {
        $hashDoBanco = $dadosUsuario['senha'];

        if (password_verify($senha, $hashDoBanco)) {
            // A senha está correta, iniciar a sessão e redirecionar para home.php
            $_SESSION['id'] = $dadosUsuario['id'];
            $_SESSION['email'] = $dadosUsuario['email'];
            $_SESSION['nome'] = $dadosUsuario['nome'];
            $_SESSION['nivel'] = $dadosUsuario['nivel'];

            // Redirecionar para a página home.php
            header("Location: ../../public/home.php");
            exit;
        } else {
            // Senha incorreta, definir uma mensagem de erro e redirecionar para login.php
            $_SESSION['erro'] = "Senha incorreta!";
            header("Location: ../../public/login.php");
            exit;
        }
    } else {
        // Usuário não encontrado, definir uma mensagem de erro e redirecionar para login.php
        $_SESSION['erro'] = "Usuário não encontrado!";
        header("Location: ../../public/login.php");
        exit;
    }
} else {
    // Campos de e-mail ou senha não preenchidos, definir uma mensagem de erro
    $_SESSION['erro'] = "Preencha todos os campos!";
    header("Location: ../../public/login.php");
    exit;
}
