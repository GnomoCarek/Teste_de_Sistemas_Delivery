<?php
session_start();

// Protege a página: só pode ser acessada por usuários logados
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$message = '';

// Verifica se a requisição é POST e se o ID do produto foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['produto_id'])) {
    $produto_id = $_POST['produto_id'];
    $arquivo_produtos = 'produtos.json';
    $produto_encontrado = false;

    if (file_exists($arquivo_produtos)) {
        $json_data = file_get_contents($arquivo_produtos);
        $produtos = json_decode($json_data, true);

        if (is_array($produtos)) {
            // Procura o produto pelo ID
            foreach ($produtos as $produto) {
                if ($produto['id'] == $produto_id) {
                    // Lógica do pedido (aqui poderia diminuir o estoque, etc)
                    $message = "Pedido para o produto '<strong>" . htmlspecialchars($produto['nome']) . "</strong>' foi recebido com sucesso!";
                    $produto_encontrado = true;
                    break;
                }
            }
        }
    }

    if (!$produto_encontrado) {
        $message = "Ocorreu um erro: produto não encontrado.";
    }

} else {
    // Se a página for acessada diretamente sem um POST
    $message = "Nenhum pedido foi realizado. Por favor, selecione um produto.";
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmação de Pedido</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Delivery System</h1>
        <nav class="menu">
            <a href="dashboard.php">Dashboard</a>
            <a href="produtos.php">Ver Produtos</a>
            <a href="logout.php">Sair</a>
        </nav>
    </header>

    <main>
        <div class="card">
            <h2>Confirmação de Pedido</h2>
            <p class="message"><?php echo $message; ?></p>
            <a href="produtos.php" class="btn">Continuar Comprando</a>
        </div>
    </main>
</body>
</html>
