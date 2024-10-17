<?php
session_start();

// Capturando os dados do formulário com validação
$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
$descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_SPECIAL_CHARS);

// Incluindo as classes
require_once '../../classes/autoload.php';

// Instanciando o objeto Category
$newCategory = new Category();

// Passando os dados capturados para o objeto Category
$newCategory->dadosDoFormulario($nome, $descricao);
$newCategory->create();

// Definir a mensagem de sucesso
$_SESSION['success_message'] = "Categoria criada com sucesso.";

// Redirecionar para a página de categorias
header("Location: ../../public/category.php");
exit;
?>
