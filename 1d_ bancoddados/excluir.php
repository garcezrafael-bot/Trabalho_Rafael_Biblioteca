<?php

// Conecta ao banco de dados
require 'conexao.php';
 
// Se tentarem acessar a página direto pela URL (sem ser clicando no botão de excluir), manda de volta pra home
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {   
    header('Location: index.php');
    exit;
}
 
try {
    // Tenta deletar o livro usando o ID enviado pelo formulário
    $consulta = $pdo->prepare("DELETE FROM livros WHERE id = :id");
    $consulta->execute([':id' => (int)$_POST['id']]);
    $msg = 'Livro excluído.';
} catch (PDOException $erro) {
    
    // Se der erro de chave estrangeira (o banco trava a exclusão), avisa o motivo real
    $msg = 'Este livro tem empréstimos registrados e não pode ser excluído.';
}

// Redireciona para a página inicial mostrando o resultado da operação
header('Location: index.php?msg=' . urlencode($msg));
exit;
