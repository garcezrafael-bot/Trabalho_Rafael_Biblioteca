<?php

// Puxa o arquivo que conecta com o banco de dados
require 'conexao.php';
 
// Pega o ID do livro (vindo da URL ou do formulário) e garante que seja um número inteiro
$id = (int)($_GET['id'] ?? $_POST['id'] ?? 0);
 
// Se o usuário clicou em salvar (enviou o formulário)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Prepara o comando SQL para atualizar os dados do livro
    $sql = "UPDATE livros
            SET titulo = :titulo, autor = :autor, ano = :ano, genero = :genero, quantidade = :quantidade
            WHERE id = :id";                 
    $consulta = $pdo->prepare($sql);
    
    // Troca os "apelidos" do SQL pelos dados reais que o usuário digitou
    $consulta->execute([
        ':titulo'     => $_POST['titulo'],
        ':autor'      => $_POST['autor'],
        ':ano'        => $_POST['ano'] !== '' ? (int)$_POST['ano'] : null, // Deixa nulo se não digitar o ano
        ':genero'     => $_POST['genero'],
        ':quantidade' => (int)$_POST['quantidade'],
        ':id'         => $id,
    ]);
    
    // Redireciona de volta para a página inicial com uma mensagem de sucesso
    header('Location: index.php?msg=' . urlencode('Livro atualizado!'));
    exit;
}
 
// Busca no banco os dados atuais desse livro específico para preencher o formulário
$consulta = $pdo->prepare("SELECT * FROM livros WHERE id = :id");
$consulta->execute([':id' => $id]);
$livro = $consulta->fetch();

// Se o ID não existir no banco, barra o usuário aqui
if (!$livro) {
    die('Livro não encontrado.');
}
 
// Carrega o cabeçalho visual do site
require 'topo.php';
?>
<!-- Formulário HTML já preenchido com as informações atuais do livro -->
<h2>Editar livro</h2>
<form method="post" class="ficha">
  <!-- Campo invisível só para mandar o ID do livro junto no clique do botão -->
  <input type="hidden" name="id" value="<?= $livro['id'] ?>">
  
  <!-- O "e()" serve para proteger os campos de textos estranhos, como você viu na conexao.php -->
  <label>Título <input name="titulo" value="<?= e($livro['titulo']) ?>" required maxlength="150"></label>
  <label>Autor <input name="autor" value="<?= e($livro['autor']) ?>" required maxlength="100"></label>
  <label>Ano <input name="ano" type="number" value="<?= e($livro['ano']) ?>"></label>
  <label>Gênero <input name="genero" value="<?= e($livro['genero']) ?>" maxlength="50"></label>
  <label>Quantidade <input name="quantidade" type="number" min="1" value="<?= e($livro['quantidade']) ?>" required></label>
  
  <button>Salvar alterações</button>
</form>
<?php 
// Carrega o rodapé visual do site
require 'rodape.php'; 
?>
