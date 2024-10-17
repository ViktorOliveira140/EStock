<?php
interface crudUser{
    public function create();
    public function buscarPorEmail($email);
    public function login($email);
    public function buscarPorId($id);
    public function read($search);
    public function update($nome, $email, $senha, $id, $paginaOrigem);
    public function delete($id);
}