<?php
require_once("../globals.php");
?>

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

<!-- Mensagens de sucesso e erro -->
<?php if (isset($_SESSION['success_message'])): ?>
    <div class="notification is-success notification-center" id="notification">
        <button class="delete"></button>
        <?php 
            echo $_SESSION['success_message'];
            unset($_SESSION['success_message']); // Remove a mensagem após exibi-la
        ?>
    </div>
<?php endif; ?>

<?php if (isset($_SESSION['error_message'])): ?>
    <div class="notification is-danger notification-center" id="notification">
        <button class="delete"></button>
        <?php 
            echo $_SESSION['error_message'];
            unset($_SESSION['error_message']); // Remove a mensagem após exibi-la
        ?>
    </div>
<?php endif; ?>




<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EStock</title>
    <link rel="short icon" href="<?= $BASE_URL ?>img/tapstock.ico" />
    <!-- Link do Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?= $BASE_URL ?>css/styles.css">
    <head>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
</head>

    <style>
    .notification-center {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 9999;
        width: 50%; /* ajuste conforme necessário */
        text-align: center;
        opacity: 0; /* Começa invisível */
        transition: opacity 0.5s ease-in-out;
    }
    .notification-center.show {
        opacity: 1;
    }

</style>

</head>

<body>