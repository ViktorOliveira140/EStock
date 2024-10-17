<?php
// Iniciar a sessão apenas se ela ainda não foi iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// Verifique se o usuário está logado e se o ID do usuário está salvo na sessão
if (!isset($_SESSION['id'])) {
    // Redireciona para a página de login se o usuário não estiver logado
    header("Location: login.php");
    exit();
}

// Obtenha o ID do usuário a partir da sessão
$id = $_SESSION['id'];
$nivel = $_SESSION['nivel'];


// Verificar se a variável 'nome' da sessão está definida
$nome = isset($_SESSION['nome']) ? $_SESSION['nome'] : '';  // Fallback para um valor vazio se não estiver definido

//Verificar se o nivel está definido na sessão
$nivelUsuario = isset($_SESSION['nivel']) ? $_SESSION['nivel'] : 'Desconhecido';

?>