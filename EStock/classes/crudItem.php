<?php
interface crudItem{
    public function create();
    public function buscarPorPatrimonio($codigo_patrimonio);
    public function buscarPorId($id);
    public function read($search);
    public function update($nome, $descricao, $codigo_patrimonio, $valor, $quantidade, $quantidade_minima, $categoria_id, $id, $paginaOrigem);
    public function delete($id);
}