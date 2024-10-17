<?php

session_start();
require_once '../../classes/autoload.php';

// Obter os dados do formulário
$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);  // ID do item
$quantidade_retirada = filter_input(INPUT_POST, 'quantidade_retirada', FILTER_SANITIZE_NUMBER_INT);  // Quantidade a retirar

// Verificar se ambos os valores foram recebidos e são números válidos
if ($id && $quantidade_retirada && $quantidade_retirada > 0) {
    // Instanciar a classe Item
    $item = new Item();
    
    // Chamar a função retirarQuantidade
    $resultado = $item->retirarQuantidade($id, $quantidade_retirada);
    
    // Verificar o resultado e definir mensagens de sucesso ou erro
    if ($resultado) {
        $_SESSION['success_message'] = "Quantidade retirada com sucesso.";
    } else {
        $_SESSION['error_message'] = "Erro ao retirar a quantidade. Tente novamente.";
    }
} else {
    $_SESSION['error_message'] = "Dados inválidos. Por favor, verifique os valores informados.";
}

// Redirecionar para a página de estoque
header("Location: ../../public/stock.php");
exit;
