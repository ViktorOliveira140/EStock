<?php

require_once '../classes/autoload.php';

$codigo_patrimonio = filter_input(INPUT_POST, 'codigo_patrimonio', FILTER_SANITIZE_SPECIAL_CHARS);


$readItem = new Item();
$readItem->buscarPorPatrimonio($codigo_patrimonio);