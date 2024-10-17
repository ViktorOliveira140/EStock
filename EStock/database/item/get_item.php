<?php
header('Content-Type: application/json');

// Incluindo as classes
require_once '../../classes/autoload.php';


// Consulta SQL para obter os itens
$sql = "SELECT nome, descricao, codigo_patrimonio, valor, quantidade, quantidade_minima, categoria_id FROM items";
$result = $conn->query($sql);

$items = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $items[] = $row;
    }
}
echo json_encode($items);

$conn->close();
?>
