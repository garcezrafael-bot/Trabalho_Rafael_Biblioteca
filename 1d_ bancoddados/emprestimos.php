<?php
// Conecta no banco de dados
require 'conexao.php';
 
// Se o usuário enviou algum formulário (clicou em algum botão)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Caso tenha clicado no botão "Devolver"
    if (isset($_POST['devolver'])) {
        // Coloca a data de hoje na devolução do empréstimo escolhido
        $consulta = $pdo->prepare("UPDATE emprestimos SET data_devolucao = CURDATE() WHERE id = :id");
        $consulta->execute([':id' => (int)$_POST['devolver']]);
        $msg = 'Devolução registrada.';
    } else {
        // Caso contrário, é um empréstimo novo. Salva os IDs e a data de hoje
        $consulta = $pdo->prepare("INSERT INTO emprestimos (livro_id, aluno_id, data_emprestimo)
                                   VALUES (:livro, :aluno, CURDATE())");
        $consulta->execute([':livro' => (int)$_POST['livro_id'], ':aluno' => (int)$_POST['aluno_id']]);
        $msg = 'Empréstimo registrado.';
    }
    // Atualiza a página mandando o aviso de sucesso por texto na URL
    header('Location: emprestimos.php?msg=' . urlencode($msg));
    exit;
}

// Puxa o cabeçalho visual da página
include 'topo.php'; 
?>

<main class="pagina-emprestimos">

    <h2>Gerenciar Empréstimos</h2>

    <!-- Se houver alguma mensagem de sucesso na URL, mostra ela aqui dentro da caixinha -->
    <?php if (isset($_GET['msg'])): ?>
        <div class="aviso"><?= htmlspecialchars($_GET['msg']) ?></div>
    <?php endif; ?>

    <!-- Formulário simples para criar um empréstimo novo -->
    <form method="POST" class="ficha">
        <h3>Novo Empréstimo</h3>
        <label>
            ID do Livro:
            <input type="number" name="livro_id" required>
        </label>
        <label>
            ID do Aluno:
            <input type="number" name="aluno_id" required>
        </label>
        <button type="submit">Registrar Empréstimo</button>
    </form>

    <br>

    <!-- Tabela que lista o histórico de quem pegou o quê -->
    <table>
        <thead>
            <tr>
                <th>Livro</th>
                <th>Aluno</th>
                <th>Data de Empréstimo</th>
                <th>Data de Devolução</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Junta as tabelas de empréstimos, livros e alunos para pegar os nomes em vez de só IDs
            // Organiza deixando os pendentes no topo e os mais recentes primeiro
            $dados = $pdo->query("SELECT e.id, l.titulo, a.nome, e.data_emprestimo, e.data_devolucao 
                                  FROM emprestimos e
                                  JOIN livros l ON e.livro_id = l.id
                                  JOIN alunos a ON e.aluno_id = a.id
                                  ORDER BY e.data_devolucao ASC, e.data_emprestimo DESC")->fetchAll();

            // Passa linha por linha jogando os dados na tabela HTML
            foreach ($dados as $linha): 
            ?>
                <tr>
                    <td><?= htmlspecialchars($linha['titulo']) ?></td>
                    <td><?= htmlspecialchars($linha['nome']) ?></td>
                    <!-- Converte o padrão do banco (AAAA-MM-DD) para a nossa data brasileira (DD/MM/AAAA) -->
                    <td><?= date('d/m/Y', strtotime($linha['data_emprestimo'])) ?></td>
                    <td>
                        <!-- Se já foi devolvido mostra a data, se não, mostra o texto "Pendente" em vermelho -->
                        <?= $linha['data_devolucao'] ? date('d/m/Y', strtotime($linha['data_devolucao'])) : '<span style="color:#DC2626; font-weight:bold;">Pendente</span>' ?>
                    </td>
                    <td class="acoes">
                        <!-- Se o livro ainda não voltou, mostra o botão para devolver -->
                        <?php if (!$linha['data_devolucao']): ?>
                            <form method="POST">
                                <button type="submit" name="devolver" value="<?= $linha['id'] ?>">Devolver</button>
                            </form>
                        <?php else: ?>
                            <!-- Se já voltou, só avisa que foi finalizado -->
                            <span style="color:#059669; font-weight:600;">Finalizado</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</main>

<?php 
// Puxa o rodapé do site
include 'rodape.php'; 
?>
