<?php
// Capturando os dados do formulário com validação
$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);

// Incluindo as classes
require_once '../../classes/autoload.php';

// Instanciando o objeto User
$newUser = new User();

// Passando os dados capturados para o objeto User
$newUser->dadosDoFormulario($nome, $email, $senha, $id_nivel);

// Criando o usuário no banco de dados
$newUser->create();

