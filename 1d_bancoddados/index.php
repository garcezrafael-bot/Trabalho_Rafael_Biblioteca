<?php
// 1. Conecta ao banco de dados e carrega o cabeçalho padrão
require 'conexao.php';
include("topo.php");

// 2. Busca todos os livros cadastrados na tabela do seu banco de dados
$consulta = $pdo->query("SELECT * FROM livros ORDER BY id DESC");
$livros_do_banco = $consulta->fetchAll();
?>

<main>
    <!-- Mostra caixas de aviso do sistema se houver mensagens na URL -->
    <?php if (isset($_GET['msg'])): ?>
        <div class="aviso"><?= htmlspecialchars($_GET['msg']) ?></div>
    <?php endif; ?>

    <div class="busca">
        <input type="text" placeholder="Buscar por título ou autor...">
        <button>Buscar</button>
    </div>

    <table>
        <tbody>
            <?php 
            if (!empty($livros_do_banco)):
                foreach ($livros_do_banco as $livro): 
                    
                    // LÓGICA DE LIMPEZA DOS NOMES DOS ARQUIVOS:
                    $titulo_formatado = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $livro['titulo']);
                    $nome_limpo = strtolower(preg_replace('/[^a-zA-Z0-9_]/', '_', str_replace(' ', '_', $titulo_formatado)));
                    $nome_limpo = preg_replace('/_+/', '_', $nome_limpo);
                    $nome_limpo = trim($nome_limpo, '_');

                    // Mapeamento cirúrgico para bater com os arquivos reais da sua pasta 'img'
                    if (strpos($nome_limpo, 'hora_da_estrela') !== false || $nome_limpo === 'a_hora_da_estrela') {
                        $nome_limpo = "a_hora_da_estrel"; // arquivo "a_hora_da_estrel.png"
                    }
                    if ($nome_limpo === "capitaes_da_areia") {
                        $nome_limpo = "Capa-Capitaes-de-Areia-Jorge-Amado"; 
                    }
                    if ($nome_limpo === "memorias_postumas_de_bras_cubas") {
                        $nome_limpo = "Memorias-Postumas-de-BrAs-Cubas-Livro"; 
                    }
                    if ($nome_limpo === "o_alienista") {
                        $nome_limpo = "o-alienista"; 
                    }

                    // ROTA ABSOLUTA DO SERVIDOR CORRIGIDA: O %20 substitui o espaço em branco na URL do navegador
                    $url_foto_base = "/1d_%20bancoddados/img/" . $nome_limpo;
            ?>
                <tr>
                    <td class="livro-aero">
                        <!-- O navegador vai buscar direto na raiz pública do XAMPP sem errar a pasta -->
                        <img src="<?= $url_foto_base; ?>.jpg" 
                             alt="Capa" 
                             onerror="
                                let base = '<?= $url_foto_base; ?>';
                                if(this.src.indexOf('.jpg') !== -1) {
                                    this.src = base + '.png';
                                } else if(this.src.indexOf('.png') !== -1) {
                                    this.src = base + '.JPG';
                                } else if(this.src.indexOf('.JPG') !== -1) {
                                    this.src = base + '.PNG';
                                } else {
                                    this.style.display='none';
                                }
                             ">
                    </td>
                    <td class="titulo"><?= e($livro['titulo']) ?></td>
                    <td>Autor: <?= e($livro['autor']) ?></td>
                    <td>Ano: <?= $livro['ano'] ? e($livro['ano']) : 'Não informado' ?></td>
                    <td>Gênero: <?= e($livro['genero']) ?></td>
                    <td>Quantidade: <?= e($livro['quantidade']) ?></td>
                    <td class="acoes">
                        <a href="editar.php?id=<?= $livro['id'] ?>">Editar</a>
                        <form method="post" action="excluir.php" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $livro['id'] ?>">
                            <button type="submit" class="perigo" onclick="return confirm('Tem certeza que quer excluir?');">Excluir</button>
                        </form>
                    </td>
                </tr>
            <?php 
                endforeach; 
            else:
            ?>
                <tr>
                    <td colspan="7">
                        <div class="aviso">Nenhum livro cadastrado no seu banco de dados ainda!</div>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</main>

<?php 
include("rodape.php"); 
?>
