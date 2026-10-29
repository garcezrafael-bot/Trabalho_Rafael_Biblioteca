<?php
/* ==========================================================================
   LISTA DE LIVROS COM ROTAS BLINDADAS PARA O SERVIDOR LOCAL (XAMPP)
   ========================================================================== */
$livros_do_sistema = [
    [
        "titulo" => "A Hora da Estrela", "autor"  => "Clarice Lispector", "ano"    => "1977", "genero" => "Romance",
        "foto"   => "/Trabalho_Rafael_Biblioteca-main/img/a_hora_da_estrela.jpg",
        "status" => "1 de 1"
    ],
    [
        "titulo" => "A Moreninha", "autor"  => "Joaquim Manuel de Macedo", "ano"    => "1844", "genero" => "Romance",
        "foto"   => "/Trabalho_Rafael_Biblioteca-main/img/a_moreninha.jpg",
        "status" => "1 de 1"
    ],
    [
        "titulo" => "Auto da Compadecida", "autor"  => "Ariano Suassuna", "ano"    => "1955", "genero" => "Teatro / Comédia",
        "foto"   => "/Trabalho_Rafael_Biblioteca-main/img/auto_da_compadecida.jpg",
        "status" => "1 de 2"
    ],
    [
        "titulo" => "Capitães da Areia", "autor"  => "Jorge Amado", "ano"    => "1937", "genero" => "Romance",
        "foto"   => "/Trabalho_Rafael_Biblioteca-main/img/Capa-Capitães-de-Areia-Jorge-Amado.jpg",
        "status" => "3 de 3"
    ],
    [
        "titulo" => "Dom Casmurro", "autor"  => "Machado de Assis", "ano"    => "1889", "genero" => "Romance",
        "foto"   => "/Trabalho_Rafael_Biblioteca-main/img/dom_casmurro.jpg",
        "status" => "2 de 3"
    ],
    [
        "titulo" => "Grande Sertão: Veredas", "autor"  => "João Guimarães Rosa", "ano"    => "1956", "genero" => "Romance",
        "foto"   => "/Trabalho_Rafael_Biblioteca-main/img/grande_sertão_veredas.jpg",
        "status" => "1 de 1"
    ],
    [
        "titulo" => "Iracema", "autor"  => "José de Alencar", "ano"    => "1865", "genero" => "Romance",
        "foto"   => "/Trabalho_Rafael_Biblioteca-main/img/iracema.jpg",
        "status" => "1 de 1"
    ],
    [
        "titulo" => "Memórias Póstumas de Brás Cubas", "autor"  => "Machado de Assis", "ano"    => "1881", "genero" => "Romance",
        "foto"   => "/Trabalho_Rafael_Biblioteca-main/img/Memorias-Postumas-de-BrAs-Cubas-Livro.jpg",
        "status" => "1 de 1"
    ],
    [
        "titulo" => "O Cortiço", "autor"  => "Aluísio Azevedo", "ano"    => "1890", "genero" => "Romance Naturalista",
        "foto"   => "/Trabalho_Rafael_Biblioteca-main/img/o_cortiço.jpg",
        "status" => "1 de 1"
    ],
    [
        "titulo" => "O Alienista", "autor"  => "Machado de Assis", "ano"    => "1882", "genero" => "Conto / Sátira",
        "foto"   => "/Trabalho_Rafael_Biblioteca-main/img/o-alienista.jpg",
        "status" => "1 de 1"
    ],
    [
        "titulo" => "Quarto de Despejo", "autor"  => "Carolina Maria de Jesus", "ano"    => "1960", "genero" => "Diário / Autobiografia",
        "foto"   => "/Trabalho_Rafael_Biblioteca-main/img/quarto_de_despejo.jpg",
        "status" => "1 de 1"
    ],
    [
        "titulo" => "Vidas Secas", "autor"  => "Graciliano Ramos", "ano"    => "1938", "genero" => "Romance Regionalista",
        "foto"   => "/Trabalho_Rafael_Biblioteca-main/img/vidas_secas.jpg",
        "status" => "1 de 1"
    ]
];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Minha Biblioteca Aero</title>
    <style>
        /* ==========================================================================
           ESTILO FRUTIGER AERO - TEXTO VERDE, SITE AZUL AQUÁTICO E BOLHAS NO FUNDO
           ========================================================================== */

        @import url('https://googleapis.com');
        * { box-sizing: border-box; font-family: 'Frutiger', 'Segoe UI', 'Corbel', 'Noto Sans', sans-serif; transition: all 0.25s cubic-bezier(0.175, 0.885, 0.32, 1.25); }

        body { 
            margin: 0; color: #022611; min-height: 100vh; -webkit-font-smoothing: antialiased; background-attachment: fixed;
            background-image: 
                radial-gradient(circle at 80% 20%, rgba(255,255,255,0.6) 0%, transparent 40%),
                radial-gradient(circle at 20% 80%, rgba(255,255,255,0.3) 0%, transparent 50%),
                radial-gradient(circle at 35% 30%, rgba(255,255,255,0.35) 0%, rgba(255,255,255,0.1) 2%, transparent 8%),
                radial-gradient(circle at 65% 70%, rgba(255,255,255,0.3) 0%, rgba(255,255,255,0.05) 3%, transparent 12%),
                linear-gradient(135deg, #54B4FF 0%, #A3E5FF 35%, #EAF9FF 60%, #7BD4FF 100%); 
            background-size: 100% 100%, 100% 100%, 200% 200%, 150% 150%, 100% 100%;
            animation: moveBubbles 18s linear infinite;
        }

        @keyframes moveBubbles {
            0% { background-position: 0% 0%, 0% 0%, 0% 300px, 0% 500px, 0% 0%; }
            100% { background-position: 0% 0%, 0% 0%, 0% -100px, 0% -250px, 0% 0%; }
        }

        header { 
            background: linear-gradient(to bottom, #79D2FF 0%, #269FFF 48%, #0055AA 50%, #0077EE 85%, #33A3FF 100%);
            backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); border-bottom: 2.5px solid rgba(255,255,255,0.8); 
            box-shadow: 0 5px 25px rgba(0,90,180,0.25), inset 0 1.5px 0 rgba(255,255,255,0.95);
            padding: 14px 24px; display: flex; align-items: center; justify-content: space-between; 
        }
        header h1 { margin: 0; font-size: 24px; font-weight: 800; color: #32CD32; text-shadow: 0 1px 2px rgba(0,0,0,0.4), 0 0 10px rgba(50,205,50,0.6); }

        nav a { color: #A1FFA1; margin-left: 18px; text-decoration: none; font-weight: 700; font-size: 14px; text-shadow: 0 1px 2px rgba(0,30,0,0.6); padding: 6px 12px; border-radius: 12px; }
        nav a:hover { background: rgba(255,255,255,0.3); color: #00FF44; box-shadow: inset 0 1px 2px rgba(255,255,255,0.6), 0 2px 8px rgba(255,255,255,0.4); }

        main { max-width: 1280px; margin: 25px auto; padding: 0 20px; display: flex; flex-direction: column; gap: 25px; }
        .busca { display: flex; gap: 12px; align-items: center; width: 100%; }
        .busca input { flex: 1; max-width: 400px; }
        input, select, button, .acoes a, .acoes button { border-radius: 25px; padding: 8px 18px; font-size: 13px; font-weight: 700; }

        input, select { background: linear-gradient(to bottom, rgba(255,255,255,0.95), rgba(240,250,255,0.8)); border: 1.5px solid #89C3EB; color: #02200B; box-shadow: inset 0 1px 3px rgba(0,90,180,0.1), 0 2px 5px rgba(0,0,0,0.03); outline: none; }
        input:focus, select:focus { border-color: #2ED14B; box-shadow: 0 0 15px rgba(46,209,75,0.7), inset 0 1px 1px #FFF; transform: scale(1.02); }

        button { background: linear-gradient(to bottom, #79D2FF 0%, #269FFF 48%, #0066CC 50%, #0088FF 85%, #33A3FF 100%); color: #FFF; border: 1px solid #004C99; text-shadow: 0 -1px 1px rgba(0,40,150,0.4); box-shadow: 0 4px 10px rgba(0,70,150,0.25), inset 0 1px 2px rgba(255,255,255,0.85); cursor: pointer; }
        button:hover { background: linear-gradient(to bottom, #99DEFF 0%, #4DCEFF 48%, #0077EE 50%, #1AA3FF 85%, #59B2FF 100%); box-shadow: 0 6px 20px rgba(0,119,255,0.45), inset 0 1px 3px rgba(255,255,255,0.95); transform: translateY(-2px); }

        table { display: grid !important; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)) !important; gap: 20px !important; width: 100%; background: transparent; border: none; box-shadow: none; }
        thead, th { display: none !important; } tbody { display: contents !important; } 

        tr { 
            display: grid !important; grid-template-columns: 75px 1fr; gap: 14px; align-items: start; position: relative; overflow: hidden;
            background: linear-gradient(135deg, rgba(255,255,255,0.85) 0%, rgba(220,240,255,0.5) 100%); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); 
            border: 2px solid rgba(255,255,255,0.95); border-radius: 22px; padding: 16px; box-shadow: 0 8px 22px rgba(0,60,130,0.06), inset 0 1px 4px rgba(255,255,255,0.95); cursor: pointer; 
        }
        tr::after { content: ''; position: absolute; top: -50%; left: -60%; width: 200%; height: 200%; pointer-events: none; background: linear-gradient(45deg, transparent 45%, rgba(255,255,255,0.35) 50%, transparent 55%); }
        tr:hover { transform: scale(1.05) translateY(-6px); border-color: rgba(65,185,255,0.7); box-shadow: 0 15px 32px rgba(0,90,220,0.2), inset 0 1px 6px #FFF, 0 0 20px rgba(65, 185, 255, 0.4); }

        td { display: block !important; padding: 0; border: none; font-size: 14px; color: #0A5C20; font-weight: 700; margin-bottom: 2px; }

        td.livro-aero { 
            grid-row: span 5; width: 65px; height: 90px; border-radius: 6px 14px 14px 6px; border: 1.5px solid #11AA11; position: relative; overflow: hidden;
            background: linear-gradient(to bottom, #94FF94 0%, #22CD22 45%, #059005 50%, #1AD01A 85%, #66FF66 100%); box-shadow: 3px 5px 12px rgba(0,50,10,0.3), inset -3px 0 5px rgba(0,0,0,0.15);
        }
        td.livro-aero::before { content: ''; position: absolute; right: 0; top: 4px; bottom: 4px; width: 8px; background: linear-gradient(to right, #DDD, #FFF 30%, #EEE); border-radius: 0 8px 8px 0; box-shadow: inset 1px 0 2px rgba(0,0,0,0.1); }
        td.livro-aero::after { content: ''; position: absolute; top: -50%; left: -60%; width: 200%; height: 200%; background: linear-gradient(45deg, transparent 45%, rgba(255,255,255,0.5) 50%, transparent 55%); }
        tr:hover td.livro-aero { transform: scale(1.08) rotate(-4deg); box-shadow: 5px 8px 16px rgba(0,50,10,0.4); }

        td.livro-aero img { width: 100%; height: 100%; object-fit: cover; border-radius: 4px 10px 10px 4px; position: absolute; top: 0; left: 0; z-index: 5; }

        td.titulo { font-weight: 800; font-size: 17px; color: #109020; line-height: 1.2; letter-spacing: -0.3px; text-shadow: 0 0 5px rgba(16,144,32,0.15); }

