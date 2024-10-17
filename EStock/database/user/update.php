<?php

$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);

require_once '../../classes/autoload.php';

$paginaOrigem = $_POST['pagina_origem'];
$updateUser = new user();
$updateUser->update($nome, $email, $senha, $id, $paginaOrigem);