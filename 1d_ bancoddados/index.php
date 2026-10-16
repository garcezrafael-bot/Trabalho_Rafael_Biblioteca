<?php

// Abre a conexão com o banco de dados
require 'conexao.php';
 
// Pega o termo digitado na barra de busca (se não digitou nada, fica vazio)
$busca = $_GET['busca'] ?? '';   
 
// Monta o SQL para buscar livros e já contar quantos estão emprestados (sem devolução)
$sql = "SELECT l.id, l.titulo, l.autor, l.ano, l.genero, l.quantidade,
               COUNT(e.id) AS emprestados
        FROM livros l
        LEFT JOIN emprestimos e
               ON e.livro_id = l.id AND e.data_devolucao IS NULL
        WHERE l.titulo LIKE :busca OR l.autor LIKE :busca2
        GROUP BY l.id, l.titulo, l.autor, l.ano, l.genero, l.quantidade
        ORDER BY l.titulo";
 
// Prepara o banco para rodar a busca com segurança
$consulta = $pdo->prepare($sql);   
// O "%" serve para achar o texto mesmo se estiver no meio, começo ou fim do nome
$consulta->execute([':busca' => "%$busca%", ':busca2' => "%$busca%"]);  
$livros = $consulta->fetchAll();
 
// Carrega o topo visual da página
require 'topo.php';
?>
<!-- Barra de busca que envia o termo digitado via URL (GET) -->
<form method="get" class="busca">
  <input type="text" name="busca" value="<?= e($busca) ?>" placeholder="Buscar por título ou autor">
  <button>Buscar</button>
</form>
 
<!-- Se tiver alguma mensagem de sucesso ou erro vinda de outra página, mostra aqui -->
<?php if (isset($_GET['msg'])): ?>
  <p class="aviso"><?= e($_GET['msg']) ?></p>
<?php endif; ?>
 
<!-- Tabela que lista os livros (o CSS transforma isso em blocos de cards!) -->
<table>
  <tr><th>Título</th><th>Autor</th><th>Ano</th><th>Gênero</th><th>Disponíveis</th><th></th></tr>
  <?php foreach ($livros as $livro): ?>
    <tr>
      <td><?= e($livro['titulo']) ?></td>
      <td><?= e($livro['autor']) ?></td>
      <td><?= e($livro['ano']) ?></td>
      <td><?= e($livro['genero']) ?></td>
      <!-- Conta matemática simples: total que a biblioteca tem menos os que estão na rua -->
      <td><?= $livro['quantidade'] - $livro['emprestados'] ?> de <?= $livro['quantidade'] ?></td>
      <td class="acoes">
        <!-- Link para a página de edição passando o ID do livro -->
        <a href="editar.php?id=<?= $livro['id'] ?>">Editar</a>
        
        <!-- Formulário para deletar enviando o ID direto pro script de exclusão -->
        <form method="post" action="excluir.php" onsubmit="return confirm('Excluir este livro?')">
          <input type="hidden" name="id" value="<?= $livro['id'] ?>">
          <button class="perigo">Excluir</button>
        </form>
      </td>
    </tr>
  <?php endforeach; ?>
</table>

<!-- Mostra a quantidade total de linhas retornadas na busca -->
<p class="total"><?= count($livros) ?> livro(s) encontrado(s).</p>

<?php 
// Carrega o rodapé visual do site
require 'rodape.php'; 
?>
