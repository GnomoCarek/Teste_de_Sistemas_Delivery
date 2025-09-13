<?php
session_start();

// Protege a página: só pode ser acessada por usuários logados
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$message = '';

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Coleta os dados do formulário
    $nome = $_POST['nome'] ?? '';
    $preco = $_POST['preco'] ?? 0;
    $detalhes = $_POST['detalhes'] ?? '';
    $desconto = $_POST['desconto'] ?? 0;
    $quantidade = $_POST['quantidade'] ?? 0;

    // Validação simples
    if (!empty($nome) && $preco > 0 && $quantidade >= 0) {
        $novo_produto = [
            'id' => time(), // ID único simples
            'nome' => $nome,
            'preco_venda' => (float)$preco,
            'detalhes' => $detalhes,
            'desconto' => (float)$desconto,
            'quantidade' => (int)$quantidade
        ];

        $arquivo_produtos = 'produtos.json';
        $produtos = [];

        // Lê produtos existentes
        if (file_exists($arquivo_produtos)) {
            $json_data = file_get_contents($arquivo_produtos);
            $produtos = json_decode($json_data, true);
        }

        // Adiciona o novo produto
        $produtos[] = $novo_produto;

        // Salva no arquivo JSON
        if (file_put_contents($arquivo_produtos, json_encode($produtos, JSON_PRETTY_PRINT))) {
            $message = 'Produto cadastrado com sucesso!';
        } else {
            $message = 'Erro ao salvar o produto.';
        }
    } else {
        $message = 'Por favor, preencha Nome, Preço de Venda e Quantidade corretamente.';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Produto</title>
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
        <section class="card">
            <h2>Cadastrar Novo Produto</h2>
            
            <?php if (!empty($message)): ?>
                <div class="message"><?php echo $message; ?></div>
            <?php endif; ?>

            <form action="cadastro_de_produto.php" method="POST">
                <div class="grid">
                    <div>
                        <label for="nome">Nome do Produto</label>
                        <input id="nome" name="nome" type="text" placeholder="Ex: Pizza de Calabresa" required>
                    </div>
                    <div>
                        <label for="preco">Preço de Venda (R$)</label>
                        <input id="preco" name="preco" type="number" step="0.01" min="0.01" placeholder="Ex: 49.90" required>
                    </div>
                    <div>
                        <label for="desconto">Desconto (R$)</label>
                        <input id="desconto" name="desconto" type="number" step="0.01" min="0" placeholder="Ex: 5.00" value="0">
                    </div>
                    <div>
                        <label for="quantidade">Quantidade em Estoque</label>
                        <input id="quantidade" name="quantidade" type="number" step="1" min="0" placeholder="Ex: 50" required>
                    </div>
                </div>
                <div style="margin-top: 14px;">
                    <label for="detalhes">Detalhes do Produto</label>
                    <textarea id="detalhes" name="detalhes" placeholder="Ingredientes, tamanho, etc."></textarea>
                </div>
                <div style="margin-top: 14px;">
                    <button type="submit">Salvar Produto</button>
                </div>
            </form>
        </section>
    </main>
</body>
</html>
