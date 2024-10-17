<?php
interface crudCategory{
    public function create();
    public function buscarPorNome($nome);
    public function buscarPorId($id);
    public function read($search);
    public function update($nome, $descricao, $id, $paginaOrigem);
    public function delete($id);
}