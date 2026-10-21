<?php

// Dados de acesso ao banco (o padrão do XAMPP)
$host  = 'localhost';   
$banco = 'biblioteca';  
$user  = 'root';        
$senha = '';            
 
try {
    // Tenta abrir a porta do banco de dados usando PDO
    $pdo = new PDO("mysql:host=$host;dbname=$banco;charset=utf8mb4", $user, $senha);
    
    // Ativa os alertas de erro para o código travar se algo der ruim
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);       
    
    // Faz o banco devolver os dados como um array simples com os nomes das colunas
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);  

} 
catch (PDOException $erro) {
    
    // Se a conexão falhar, para tudo e mostra esse aviso amigável na tela
    die('Não consegui conectar ao banco: ' . $erro->getMessage() .
        '<br>Confira se o MySQL está ligado no painel do XAMPP e se o banco.sql foi importado.');
}

// Funçãozinha rápida pra evitar que o usuário injete código malicioso (XSS) no HTML
function e($texto) {
    
    return htmlspecialchars((string)$texto, ENT_QUOTES, 'UTF-8');
}
