<?php
require_once '../../classes/autoload.php';

// Instancie a classe que contém a função read
$readItem = new Item();
$data = $readItem->dashEstoque(); // Armazena o retorno do método diretamente na variável

// Verifique se os dados foram retornados e, em seguida, envie em JSON
if (!empty($data)) {
    echo json_encode($data);
} else {
    echo json_encode([]);
}
