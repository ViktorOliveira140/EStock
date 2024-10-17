<?php
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

require_once '../../classes/autoload.php';
if ($id){
    //Instanciar a classe categoria
    $deleteCategory = new Category();

    //Chamar a função delete
    $deleteCategory->delete($id);

    //Verificar o resultado e definir as mensagens de erro e sucesso
    if($deleteCategory){
        $_SESSION['success_message'] = "Categoria apagada com sucesso.";
    } else {
        $_SESSION['error_message'] = "Erro ao apagar a categoria. Erro Cod.#PlimPlimPlom.";
    }
} else{
    $_SESSION['error_message'] = "ID inválido. Por favor verifique os dados informados.";
}

// Redirecionar para a página de categorias
header("Location: ../../public/category.php");
exit;
?>
