<?php
// Inclui o topo padrão do seu sistema
include("topo.php");

/* ==========================================================================
   LISTA DE LIVROS INTEGRADA COM ROTAS ABSOLUTAS DO SERVIDOR LOCAL (XAMPP)
   ========================================================================== */
$livros_do_sistema = [
    [
        "titulo" => "A Hora da Estrela", "autor"  => "Clarice Lispector", "ano"    => "1977", "genero" => "Romance",
        "foto"   => "/Trabalho_Rafael_Biblioteca-main/img/a_hora_da_estrel.png", // Rota começando da raiz do localhost
        "status" => "1 de 1"
    ],
    [
        "titulo" => "A Moreninha", "autor"  => "Joaquim Manuel de Macedo", "ano"    => "1844", "genero" => "Romance",
        "foto"   => "/Trabalho_Rafael_Biblioteca-main/img/a_moreninha.png",
        "status" => "1 de 1"
    ],
    [
        "titulo" => "Auto da Compadecida", "autor"  => "Ariano Suassuna", "ano"    => "1955", "genero" => "Teatro / Comédia",
        "foto"   => "/Trabalho_Rafael_Biblioteca-main/img/auto_da_compadecida.png",
        "status" => "1 de 2"
    ],
    [
        "titulo" => "Capitães da Areia", "autor"  => "Jorge Amado", "ano"    => "1937", "genero" => "Romance",
        "foto"   => "/Trabalho_Rafael_Biblioteca-main/img/Capa-Capitaes-de-Areia-Jorge-Amado.png",
        "status" => "3 de 3"
    ],
    [
        "titulo" => "Dom Casmurro", "autor"  => "Machado de Assis", "ano"    => "1889", "genero" => "Romance",
        "foto"   => "/Trabalho_Rafael_Biblioteca-main/img/dom_casmurro.png",
        "status" => "2 de 3"
    ],
    [
        "titulo" => "Grande Sertão: Veredas", "autor"  => "João Guimarães Rosa", "ano"    => "1956", "genero" => "Romance",
        "foto"   => "/Trabalho_Rafael_Biblioteca-main/img/grande_sertao_veredas.png",
        "status" => "1 de 1"
    ],
    [
        "titulo" => "Iracema", "autor"  => "José de Alencar", "ano"    => "1865", "genero" => "Romance",
        "foto"   => "/Trabalho_Rafael_Biblioteca-main/img/iracema.png",
        "status" => "1 de 1"
    ],
    [
        "titulo" => "Memórias Póstumas de Brás Cubas", "autor"  => "Machado de Assis", "ano"    => "1881", "genero" => "Romance",
        "foto"   => "/Trabalho_Rafael_Biblioteca-main/img/Memorias-Postumas-de-BrAs-Cubas-Livro.png",
        "status" => "1 de 1"
    ],
    [
        "titulo" => "O Cortiço", "autor"  => "Aluísio Azevedo", "ano"    => "1890", "genero" => "Romance Naturalista",
        "foto"   => "/Trabalho_Rafael_Biblioteca-main/img/o_cortico.png",
        "status" => "1 de 1"
    ],
    [
        "titulo" => "O Alienista", "autor"  => "Machado de Assis", "ano"    => "1882", "genero" => "Conto / Sátira",
        "foto"   => "/Trabalho_Rafael_Biblioteca-main/img/o-alienista.png",
        "status" => "1 de 1"
    ],
    [
        "titulo" => "Quarto de Despejo", "autor"  => "Carolina Maria de Jesus", "ano"    => "1960", "genero" => "Diário",
        "foto"   => "/Trabalho_Rafael_Biblioteca-main/img/quarto_de_despejo.png",
        "status" => "1 de 1"
    ],
    [
        "titulo" => "Vidas Secas", "autor"  => "Graciliano Ramos", "ano"    => "1938", "genero" => "Romance Regionalista",
        "foto"   => "/Trabalho_Rafael_Biblioteca-main/img/vidas_secas.png",
        "status" => "1 de 1"
    ]
];
?>

<main>
    <div class="busca">
        <input type="text" placeholder="Buscar por título ou autor...">
        <button>Buscar</button>
    </div>

    <table>
        <tbody>
            <?php foreach ($livros_do_sistema as $livro): ?>
                <tr>
                    <td class="livro-aero">
                        <!-- O navegador busca direto da raiz do servidor local, eliminando erros de subpasta -->
                        <img src="<?php echo $livro['foto']; ?>" alt="Capa" onerror="this.style.display='none';">
                    </td>
                    <td class="titulo"><?php echo $livro['titulo']; ?></td>
                    <td>Autor: <?php echo $livro['autor']; ?></td>
                    <td>Ano: <?php echo $livro['ano']; ?></td>
                    <td>Gênero: <?php echo $livro['genero']; ?></td>
                    <td>Status: <?php echo $livro['status']; ?></td>
                    <td class="acoes">
                        <a href="editar.php">Editar</a>
                        <button type="button" class="perigo">Excluir</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>

<?php 
// Inclui o rodapé padrão do seu sistema
include("rodape.php"); 
?>
