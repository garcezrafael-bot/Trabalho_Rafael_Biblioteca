<?php

// Puxa a conexão com o banco de dados
require 'conexao.php';
 
// Se o usuário preencheu o formulário e clicou em Salvar
if ($_SERVER['REQUEST_METHOD'] === 'POST') {          
    // Prepara a ordem para inserir o novo livro no banco de dados
    $sql = "INSERT INTO livros (titulo, autor, ano, genero, quantidade)
            VALUES (:titulo, :autor, :ano, :genero, :quantidade)";
    $consulta = $pdo->prepare($sql);
    
    // Troca as marcações do SQL pelos dados reais que vieram do formulário
    $consulta->execute([
        ':titulo'     => $_POST['titulo'],
        ':autor'      => $_POST['autor'],
        // Se o ano veio vazio, salva como nulo no banco para não dar erro
        ':ano'        => $_POST['ano'] !== '' ? (int)$_POST['ano'] : null,
        ':genero'     => $_POST['genero'],
        ':quantidade' => (int)$_POST['quantidade'],
    ]);
    
    // Manda o usuário de volta para a lista principal com o aviso de sucesso na URL
    header('Location: index.php?msg=' . urlencode('Livro cadastrado!'));  
    exit;
}
 
// Carrega o topo visual da página
require 'topo.php';
?>
<!-- Formulário limpo pronto para cadastrar um novo livro -->
<h2>Novo livro</h2>
<form method="post" class="ficha">
  <label>Título <input name="titulo" required maxlength="150"></label>
  <label>Autor <input name="autor" required maxlength="100"></label>
  <label>Ano <input name="ano" type="number"></label>
  <label>Gênero <input name="genero" maxlength="50"></label>
  <!-- Já começa com a quantidade padrão em 1 e não deixa colocar menos que isso -->
  <label>Quantidade <input name="quantidade" type="number" min="1" value="1" required></label>
  <button>Salvar</button>
</form>
<?php 
// Carrega o rodapé do site
require 'rodape.php'; 
?>
