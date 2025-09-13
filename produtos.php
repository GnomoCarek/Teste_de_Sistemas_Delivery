<?php
session_start();

// Protege a página: só pode ser acessada por usuários logados
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$arquivo_produtos = 'produtos.json';
$produtos = [];

// Lê os produtos do arquivo JSON
if (file_exists($arquivo_produtos)) {
    $json_data = file_get_contents($arquivo_produtos);
    // O segundo argumento `true` converte o objeto JSON em um array associativo
    $todos_produtos = json_decode($json_data, true);
    if (is_array($todos_produtos)) {
        // Pega apenas os 5 primeiros produtos para exibição
        $produtos = array_slice($todos_produtos, 0, 5);
    }
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nossos Produtos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Delivery System</h1>
        <nav class="menu">
            <a href="dashboard.php">Dashboard</a>
            <a href="cadastro_de_produto.php">Cadastrar Produto</a>
            <a href="logout.php">Sair</a>
        </nav>
    </header>

    <main>
        <section class="card">
            <h2>Nossos Produtos</h2>
            <?php if (empty($produtos)): ?>
                <p>Nenhum produto cadastrado no momento. Volte em breve!</p>
            <?php else: ?>
                <div class="grid">
                    <?php foreach ($produtos as $produto): ?>
                        <div class="product-card">
                            <h3><?php echo htmlspecialchars($produto['nome']); ?></h3>
                            <p><?php echo htmlspecialchars($produto['detalhes']); ?></p>
                            <div class="price-section">
                                <?php 
                                $preco_final = $produto['preco_venda'] - $produto['desconto'];
                                ?>
                                <span class="price">R$ <?php echo number_format($preco_final, 2, ',', '.'); ?></span>
                                <?php if ($produto['desconto'] > 0): ?>
                                    <span class="original-price">R$ <?php echo number_format($produto['preco_venda'], 2, ',', '.'); ?></span>
                                <?php endif; ?>
                            </div>
                            <form action="pedido.php" method="POST">
                                <input type="hidden" name="produto_id" value="<?php echo $produto['id']; ?>">
                                <?php if ($produto['quantidade'] > 0): ?>
                                    <button type="submit" class="btn">Fazer Pedido</button>
                                <?php else: ?>
                                    <button type="button" class="btn disabled" disabled>Sem Estoque</button>
                                <?php endif; ?>
                            </form>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </section>
    </main>
</body>
</html>
